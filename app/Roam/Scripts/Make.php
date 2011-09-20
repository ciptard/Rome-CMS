<?php

require_once 'Roam/Scripts/Inflection.php';

class Roam_Scripts_Make
{
	protected $_data = array();
	protected $_fieldData = array();
	protected $_path = '';
	
	protected $_formFields = array(
		'id' => 'hidden',
		'int' => 'input',
		'varchar' => 'input',
		'date' => 'input',
		'datetime' => 'input',
		'text' => 'textarea',
		'blog' => 'textarea',
		'longtext' => 'textarea',
		'enum' => 'input'
	);

	public function __construct($make) {
		$this->generateNames($make);
		$this->getTableDetails();
		$this->_path = dirname(__FILE__) . '/../../';
	}
	
	public function setPath($path) {
		$this->_path = $path;
		return $this;
	}
	
	public function make() {
		$path = $this->_path;
		
		print "Making the Controller...\n";
		
		// controller
		Roam_Scripts_File::create(
			$path . $this->controllerFileName,
			$this->controller()
		);
		
		print "Making the Model...\n";

		// model
		Roam_Scripts_File::create(
			$path . $this->modelFileName,
			$this->model()
		);
		
		print "Making the Views Directory...\n";
		
		Roam_Scripts_File::directory($path . $this->viewFolder);

		print "Making the Views...\n";

		Roam_Scripts_File::create(
			$path . $this->viewFolder . 'index.php',
			$this->index()
		);

		Roam_Scripts_File::create(
			$path . $this->viewFolder . 'create.php',
			$this->editCreate()
		);

		Roam_Scripts_File::create(
			$path . $this->viewFolder . 'edit.php',
			$this->editCreate()
		);

		Roam_Scripts_File::create(
			$path . $this->viewFolder . 'form.php',
			$this->form()
		);
		
		print "DING! DONE!\n";
	}
	
	public function generateNames($string) {
		$singular = ucfirst(Inflect::singularize($string));
		$plural = ucfirst(Inflect::pluralize($string));
		$this->_data = array(
			'controller' => strtolower($plural),
			'model' => strtolower($singular),
			'modelName' => 'Models_' . $singular,
			'controllerName' => 'Controllers_' . $plural,
			'table' => $plural,
			'idName' => strtolower($singular . '_id'),
			'controllerFileName' => 'Controllers/' . $plural . '.php',
			'modelFileName' => 'Models/' . $singular . '.php',
			'viewFolder' => 'Views/' . strtolower($plural) . '/'
		);
	}
	
	public function getTableDetails() {
		try {
			$this->_fieldData = Database::get()->MetaColumns($this->table);
		} catch (Exception $e) {
			die("There was a problem. Maybe the table (" . $this->table .") doesn't exist?");
		}
	}

	public function __get($name) {
		return ($this->_data[$name])? $this->_data[$name] : false;
	}
	
	public function controller() {
		$template = "<?php\n\n"
				  . "class " . $this->controllerName . " extends Controllers_AppBaseController\n"
				  . "{\n"
				  . "\tprotected " . '$_controller' . " = '" . $this->controller . "';\n"
				  . "\tprotected " . '$_action' . " = 'index';\n"
				  . "\tprotected " . '$_model' . ";\n\n"
				  . "\tpublic function __construct() {\n"
				  . "\t\t" . '$this->_action' . " = Roam::getAction();\n"
				  . "\t\t" . '$this->_model' . " = new " . $this->modelName . "();\n"
				  . "\t\t" . '$this->setTitle(' . "'The " . $this->table . "'" . ');' . "\n"
				  ."\t}\n"
				  ."}\n";
		return $template;
	}
	
	public function model() {
		$template = "<?php\n\n"
				  . "class " . $this->modelName . " extends Models_AppBaseModel\n"
				  . "{\n"
				  . "\tprotected " . '$_table' . " = '" . $this->table . "';\n"
				  . "\tprotected " . '$_idName' . " = '" . $this->idName . "';\n"
				  . "}\n";
		return $template;
	}
	
	public function editCreate() {
		return "<?php require_once 'form.php'; ?>";
	}
	
	public function form() {
		$template = '<div class="in forms">' . "\n"
				  . '<form action="/' . $this->controller
				  . '/<?= ($formAction)? $formAction : ' . "'save'" . ' ?>/" method="post">' . "\n"
				  . '<input type="hidden" name="id" value="<?= $data[' . "'"
				  . $this->idName . "'" . '] ?>" />' . "\n";
		
		foreach ($this->_fieldData as $field) {
			if (!in_array($field->name, array('created', 'modified', $this->idName))) {
				$template .= $this->element($this->_formFields[$field->type], $field->name);
			}
		}
		
		$template .= '<p><input type="submit" value="SAVE ' . strtoupper($this->model) . '" class="com_btn" />'
				  .  '<a class="formCancel" href="/<?= ' . $this->controller . ' ?>/">Cancel</a></p>' . "\n"
				  .  "</form>\n</div>\n";
		return $template;
	}
	
	public function element($type, $name) {
		$template = "";
		switch ($type) {
			case 'textarea':
				$template = $this->textarea($name);
				break;
			default:
				$template = $this->input($name);
				break;
		}
		return $template;
	}
	
	public function label($label) {
		return '<label for="' . $label . '">' . $this->humanTitle($label) . '</label>';
	}
	
	public function input($name) {
		$template = '<p>' . $this->label($name) . "\n"
				  . '<input type="text" name="' . $name . '" id="' . $name . '" size="30" '
				  . 'value="<?= $data[' . "'" . $name . "'" . '] ?>" class="box" /></p>' . "\n";
		return $template;
	}
	
	public function textarea($name) {
		$template = '<p>' . $this->label($name) . "\n"
				  . '<textarea rows="10" cols="50" '
				  . 'name="' . $name . '" id="' . $name . '" '
				  . 'class="box"><?= $data[' . "'" . $name . "'" . '] ?></textarea></p>' . "\n";
		return $template;
	}
	
	public function humanTitle($string) {
		return ucwords(str_replace('_', ' ', $string));
	}
	
	public function index() {
		$headers = "";
		$rows = "";
		foreach ($this->_fieldData as $field) {
			if (!in_array($field->name, array($this->idName))) {
				$headers .= "\t\t\t" . '<th>' . $this->humanTitle($field->name) . '</th>' . "\n";
				$rows .= "\t\t\t" . '<td><?= $row[' . "'" . $field->name . "'" . '] ?></td>' . "\n";
			}
		}
	
		$template = '<div class="in">' . "\n"
				  . "\t"  . '<table width="850" border="0" cellspacing="0" '
				  . 'cellpadding="10" class="table_main" >' . "\n"
				  . "\t\t" . '<tr class="header">' . "\n"
				  . $headers
				  . "\t\t\t" . '<th>Actions</th>' . "\n"
				  . "\t\t" . '</tr>' . "\n"
				  . "\t\t" . '<?php if ($data) { foreach ($data as $row) { ?>' . "\n"
				  . "\t\t" . '<tr>' . "\n"
				  . $rows
			 	  . "\t\t\t<td>\n"
			  	  . "\t\t\t\t" . '<a href="/' . $this->controller . '/edit/<?= $row[' . "'"
			  	  . $this->idName . "'" . '] ?>/">Edit</a> - ' . "\n"
			  	  . "\t\t\t\t" . '<a href="/' . $this->controller . '/delete/<?= $row[' . "'"
			  	  . $this->idName . "'" . '] ?>/">Delete</a>' . "\n"
			  	  . "\t\t\t" . '</td>' . "\n"
				  . "\t\t" . '</tr>' . "\n"
				  . "\t\t" . '<?php } } ?>' . "\n"
				  . "\t" . '</table>' . "\n"
				  . '</div>' . "\n\n"
				  . '<div class="in">' . "\n"
				  . "\t" . '<p><a href="/' . $this->controller . '/create/">New '
				  . $this->humanTitle($this->model) . '</a></p>' . "\n"
				  . '</div>' . "\n";
		
		return $template;
	}
}
