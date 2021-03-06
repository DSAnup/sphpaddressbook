<?php
namespace sPHP;

#region Entity management common configuration
$EM = new EntityManagement($Table[$Entity = "PersonPhone"]);

# ImportField is used to upload csv file for data insert, make sure all required fields.
$EM->ImportField([
	new Database\Field("" . ($Field = "Person") . "ID", "" . ($Column = "{$Field}Name") . "", null, $Table["{$Field}"], null),
	new Database\Field("{$Entity}" . ($Field = "Number") . "", "{$Field}"),
	new Database\Field("{$Entity}Is" . ($Field = "Active") . "", "{$Field}"),
]);

# InputValidation is used to input type validation & required fields.
$EM->InputValidation([
	new HTTP\InputValidation("PersonID", true, VALIDATION_TYPE_INTEGER),
	new HTTP\InputValidation("{$Entity}Number", true),
	new HTTP\InputValidation("{$Entity}IsActive", null, VALIDATION_TYPE_INTEGER),
]);

# ValidateInput is used to check custom query input validation.
$EM->ValidateInput(function($Entity, $Database, $Table, $PrimaryKey, $ID){
	$Result = true;

	if($Table->Get( // Check for duplicate values for UNIQUE columns
		//Check same person have same phone
		"
			(
					{$Table->Alias()}." . ($Column = "PersonID") . " = " . intval($_POST["{$Column}"]) . "
				AND	" . ($Column = "{$Entity}Number") . " = '{$Database->Escape($_POST["{$Column}"])}'
			)
			AND	{$PrimaryKey} <> {$ID}
		"
	, null, null, null, null, null, null))$Result = "Same person and name for the same " . strtolower($Table->FormalName()) . " exists!";

	return $Result;
});

#
$EM->ThumbnailColumn("x{$Entity}Picture");

# BeforeInput is used to check custom query before insert data into database.
$EM->BeforeInput(function($Entity, $Record){

	return true;
});

# IntermediateEntity is used to secondary entity inside primary entity. 
$EM->IntermediateEntity("xCategory, xEvent");

# DefaultFromSearchColumn is used to set default search column.
$EM->DefaultFromSearchColumn("xTerminalID, xCustomerID, xCarrierID");

# ListColumn shows available datagrid with fields caption, fields value etc.
$EM->ListColumn([
	new HTML\UI\Datagrid\Column("" . ($Caption = "Person") . "Name", "{$Caption}", null, null),
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Type") . "", "{$Caption}", null),
	new HTML\UI\Datagrid\Column("{$Entity}" . ($Caption = "Number") . "", "{$Caption}", null),
	new HTML\UI\Datagrid\Column("{$Entity}Is" . ($Caption = "Active") . "", "{$Caption}", FIELD_TYPE_BOOLEANICON),
]);

# Action is an part of datagrid columns. It's show every records.
$EM->Action([
	new HTML\UI\Datagrid\Action("{$Environment->IconURL()}edit.png", null, $Application->URL($_POST["_Script"], "btnInput"), null, null, null, "Edit"),
	new HTML\UI\Datagrid\Action("{$Environment->IconURL()}delete.png", null, $Application->URL($_POST["_Script"], "btnDelete"), null, "return confirm('Are you sure to remove the information?');", null, "Delete"),
]);

# BatchActionHTML is used for bulk operation. Batch action button shows top of the List Columns.
$EM->BatchActionHTML([
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}search.png\" alt=\"Search\" class=\"Icon\">Search", BUTTON_TYPE_SUBMIT, "btnSearch", true),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}add.png\" alt=\"Add new\" class=\"Icon\">Add new", BUTTON_TYPE_SUBMIT, "btnInput", true),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}delete.png\" alt=\"Remove\" class=\"Icon\">Remove", BUTTON_TYPE_SUBMIT, "btnDelete", true, "return confirm('Are you sure to remove the information?');"),
	HTML\UI\Button("<img src=\"{$Environment->IconURL()}export.png\" alt=\"Export\" class=\"Icon\">Export", BUTTON_TYPE_SUBMIT, "btnExport", true),
]);

# Configuration Section
$EM->OrderBy("PersonName ASC, {$Entity}Number"); # Order by fields
$EM->Order("ASC"); # Return record ASC / DESC
$EM->URL($Application->URL($_POST["_Script"])); # Current script URL
$EM->IconURL($Environment->IconURL()); # Icon URL
$EM->EncryptionKey($Application->EncryptionKey()); # Encryption Key
$EM->FieldCaptionWidth($Configuration["FieldCaptionWidth"]); # Set field caption width / by default it's configure in configuration file.
$EM->FieldCaptionInlineWidth($Configuration["FieldCaptionInlineWidth"]); # Set field caption inline width / by default it's configure in configuration file.
$EM->FieldContentFullWidth($Configuration["FieldContentFullWidth"]); # Set field caption width / by default it's configure in configuration file.
$EM->InputWidth($Configuration["InputWidth"]); # Set input field width / by default it's configure in configuration file.
$EM->InputInlineWidth($Configuration["InputInlineWidth"]); # Set input field inline width / by default it's configure in configuration file.
$EM->InputFullWidth($Configuration["InputFullWidth"]); # Set input field full width / by default it's configure in configuration file.
$EM->InputDateWidth($Configuration["InputDateWidth"]); # Set input date field width / by default it's configure in configuration file.
$EM->TempPath($Environment->TempPath()); # Set temporary path location
$EM->SearchInputPrefix($Configuration["SearchInputPrefix"]); # Set search input prefix
$EM->UploadPath($Environment->UploadPath()); # Set image uploaded path.
$EM->ThumbnailMaximumDimension(48); # Picture thumbnail dimension.
$EM->RecordsPerPage(200); //$Configuration["DatagridRowsPerPage"]
$EM->BaseURL($Environment->URL()); // ??????????? Base URL Location
#endregion Entity management common configuration

# Import Section
if(isset($_POST["btnImport"])){
	if(isset($_POST["btnSubmit"])){
		$EM->Import();
		$Terminal->Redirect($_POST["_Referer"]);
	}

	print $EM->ImportHTML();
}

# Bulk Delete / Delete an record
if(isset($_POST["btnDelete"])){
	$EM->Delete();
	$Terminal->Redirect($_SERVER["HTTP_REFERER"]);
}

# Insert / Update record into database
if(isset($_POST["btnInput"])){
	$NewRecordMode = isset($_POST["{$Entity}ID"]) && intval($_POST["{$Entity}ID"]) ? false : true;

	if(isset($_POST["btnSubmit"])){
		#region Custom code
		#endregion Custom code

		if($EM->Input()){
			$Terminal->Redirect("{$_POST["_Referer"]}&SucceededAction=Input"); // Redirect to previous location
		}
	}

	$EM->LoadExistingData();
	#region Custom code
	#endregion Custom code

	# Input Form Section
	$EM->InputUIHTML([
		HTML\UI\Field(HTML\UI\Select("" . ($Caption = "Person") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get("{$Table["{$OptionEntity}"]->Alias()}.{$OptionEntity}IsActive = 1", "{$OptionEntity}LookupCaption ASC"), null, "{$OptionEntity}LookupCaption"), "{$Caption}", null, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\RadioGroup("{$Entity}" . ($Caption = "Type") . "", [new HTML\UI\Radio("Home", "Home"), new HTML\UI\Radio("Office", "Office")]), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\Input("{$Entity}" . ($Caption = "Number") . "", $EM->InputWidth(), null, true), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
		HTML\UI\Field(HTML\UI\RadioGroup("{$Entity}Is" . ($Caption = "Active") . "", [new HTML\UI\Radio(1, "Yes"), new HTML\UI\Radio(0, "No")]), "{$Caption}", true, null, $EM->FieldCaptionWidth()),
	]);

	# Print the input form
	print $EM->InputHTML();
}

#Sql Search Section
$EM->SearchSQL([
	"1 = 1", // Custom fixed search condition
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "PersonID") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}Number") . "", SetVariable($Column)) ? "{$Table["{$Entity}"]->Alias()}.{$Column} LIKE '%{$Database->Escape($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"])}%'" : null,
	SetVariable("{$Configuration["SearchInputPrefix"]}" . ($Column = "{$Entity}IsActive") . "", SetVariable($Column, "")) !== "" ? "{$Table["{$Entity}"]->Alias()}.{$Column} = " . intval($_POST["{$Configuration["SearchInputPrefix"]}{$Column}"]) . "" : null,
]);

# Searching form html
$EM->SearchUIHTML([
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}" . ($Caption = "Person") . "ID", $Table[$OptionEntity = "{$Caption}"]->Get(null, "" . ($OptionEntityOrderBy = "{$OptionEntity}LookupCaption") . " ASC"), new Option(), "{$OptionEntityOrderBy}"), "{$Caption}", null, null),
	HTML\UI\Field(HTML\UI\Input("{$Configuration["SearchInputPrefix"]}{$Entity}" . ($Caption = "Number") . "", 200), "{$Caption}", null, true),
	HTML\UI\Field(HTML\UI\Select("{$Configuration["SearchInputPrefix"]}{$Entity}Is" . ($Caption = "Active") . "", [new Option(), new Option(0, "No"), new Option(1, "Yes")]), "{$Caption}", null, true),
]);

# Export data section
if(isset($_POST["btnExport"])){
	$Application->DocumentType(DOCUMENT_TYPE_CSV, true); // Set output type and clear any previous output
	$Terminal->DocumentName("{$Entity}_" . date("Y-m-d_H-i-s") . ".csv"); // Set client side default file name

	print $Table["{$Entity}"]->Export(
		"PersonName, {$Entity}Number, {$Entity}Type,", # Column name
		str_replace(" ", null, "Person, Number, Type"), # Column Value
		IMPORT_TYPE_CSV, null, $EM->SearchSQL(), "{$_POST["OrderBy"]} {$_POST["Order"]}"
	);

	$Terminal->Suspended(true); // Suspend any further output
}

# Print list items
print "{$EM->ListHTML()}";
if(SetVariable("SucceededAction") == "Input")print HTML\UI\Toast("{$Table["{$Entity}"]->FormalName()} input successful.");
#region List
?>