# API File manager PHP
API created in PHP - File manager  (read, rename, upload, delete)

API created to use it in the [Angular Admin Files project][1].

[1]: <https://github.com/vivianmartinez/project-admin-files>

## Requests

### GET

```
//Get all files
url_api/services/read-files.php

//Get files from a specified route
url_api/services/read-files.php?route=files
url_api/services/read-files.php?route=files/folder-01

//Get a single file
url_api/services/read-files.php?route=files/folder-01/filename

//Rename a file
url_api/services/rename-files.php?route=files/folder-01&old_name=filename&rename=newname

//delete a file
url_api/services/delete-files.php?route=files/folder-01&name_file=filename

```
### POST

```
//Upload file
url_api/services/save-files.php

//Request Body form-data
[
  'route' => name_route,
  'file'  => file // type file
] 

```
