# Create An Address Book System With sPHP Framework

Develop a simple system that holds contact information with multiple address and phone numbers using sPHP Framework.

## Entity

* Contact: Each contact will contain information like first name, last name, date of birth and email address.
* Address: Each address should contain information for name (home, office, etc.), street, city, state, ZIP/PO & country name. Each address must belong to a contact and a contact can have multiple addresses.
* Phone: Each phone should contain information for name (land, mobile, office, day, etc.) and the number. Each phone must belong to a contact and a contact can have more than one phone numbers.

## InterFace

* Contact: List of the available contacts in the system & add new/edit & delete interface.
* Address: Same type of list, add new/edit & delete interface.
* Phone: Same type of list, add new/edit & delete interface.

## Simple Steps

**Step 1:** Clone / download the sPHP Framework on your server.

**Step 2:** Clone / download the sample application / template on your server.

**Step 3:** Open 'index.php' inside your application directory & update the file to locate the sPHP framework 'engine.php'.

**Step 4:** Create a database & configure the settings under 'system/configuration' file.

**Step 5:** Run the defaul sphp sql on your created database.

**Step 6:** Run the contact sql on your database.

**Step 7:** Run the application on your browser.

## Note

* Follow the commit section step by step for work flow.
* To access a script you must be sign in
* Email : Administrator@System.Dom
* Password : password
* Check comments inside script for better understand of Entity Management.
* Framework is Case Sensitive.
* It's better to use CamelCase in Table Field name. You can check the format in 'contact.sql'.
* When you run a script it's generate sql file for particular entity automaticaly under database folder.
* For script icon just copy & paste a png file under image/icon directory and rename it small letter same as entity name without use entity prefix.
