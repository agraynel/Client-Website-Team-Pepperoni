/* Form validation

!!!!!!!!!!!PROJECT3 modified from validation.js in project 2　
  CREDITS: 
  https://www.tutorialspoint.com/javascript/javascript_form_validations.htm
  http://www.w3schools.com/js/js_validation.asp
   http://www.w3schools.com/js/tryit.asp?filename=tryjs_validation_number
*/

/**Strip_tag implement in javascript 
CREDIT: http://locutus.io/php/strings/strip_tags/
Modified to boolean function. Remove allowable tags.
Return false if it has tags.
Return true if it is the same after removing tags
*/

//filter tags
function strip_tags (input) { //
  // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
  var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  var output = input.replace(commentsAndPhpTags, '');
  return (input == output);
}

// Check name valid, name should not be empty.
function validName(name) {
  //Photo name can have characters, spaces, numbers, underscores, dashes and name can't be all spaces
  var isValidLetter = /\S/.test(name) && /^[A-Za-z0-9\s-_]+$/.test(name);
  var isValidNameLength = (name !== '') && name.length <= 100;
  var isValidName = isValidLetter && isValidNameLength && strip_tags(name);
  return (isValidName);
}

//Check valid input introduction. 0 ~ 1000 characters. can be empty
function validIntro(text) {
  //var notAllSpaces = /\S/.test(text); 
  var isValidLength = text.length <= 1000;
  var isValidIntro = strip_tags(text) && isValidLength;
  return isValidIntro;
}

/** add album part*/

// validate the add album form
function validateAlbum() {
  var aName = validName(document.forms.add_form.album_name.value);
  var aIntro = validIntro(document.forms.add_form.album_intro.value);
  if (!aName) {
    showError("add_error_message", "Please enter a valid name.");
  }
  if (!aIntro) {
    showError("add_error_message", "Please enter a valid introduction between 0 ~ 1000 characters!");
  }
  isValidAlbum = aName && aIntro;
  if (isValidAlbum) {
    showError("add_error_message", "Album added!");
  }
  return isValidAlbum;
}

/** ======================================================================================================
    ======================================================================================================
upload photos part*/

/* check it is a valid image file
   CREDITS:
   Extract the file name from the path:
    http://stackoverflow.com/questions/857618/javascript-how-to-extract-filename-from-a-file-input-control
*/
function validImage(file) {
  var startIndex = (file.indexOf('\\') >= 0 ? file.lastIndexOf('\\') : file.lastIndexOf('/'));
    var filename = file.substring(startIndex);
    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
        filename = filename.substring(1);
    }
  //console.log(filename);
  var isvalidImage = filename.endsWith(".jpg") || filename.endsWith(".png") || filename.endsWith(".bmp") || filename.endsWith(".gif") || filename.endsWith(".jpge") || filename.endsWith(".JPG") || filename.endsWith(".PNG") || filename.endsWith(".BMP") || filename.endsWith(".GIF") || filename.endsWith(".JPGE");
  return isvalidImage;
}

// validate the upload photo form
function validatePhoto() {
  var pName = validName(document.forms.upload_photo.photo_name.value);
  // CREDITS http://stackoverflow.com/questions/1804745/get-the-filename-of-a-fileupload-in-a-document-through-javascript
  var file = document.getElementById("photo_file_upload").value;
  var pImage = validImage(file);
  //console.log(file);
  var pIntro = validIntro(document.forms.upload_photo.photo_intro.value);
  if (!pName) {
    showError("upload_error_message", "Please enter a valid name.");
  }
  if (!pIntro) {
    showError("upload_error_message", "Please enter a valid introduction between 0 ~ 1000 characters!");
  }
  if (!pImage) {
    showError("upload_error_message", "Please upload a valid image!");
  }
  var isValidPhoto = pName && pImage && pIntro;
  return isValidPhoto;
}

// validate the add admin
function validateAdmin() {
  var pTitle = validName(document.forms.add_admin_form.admin_title.value);
  // CREDITS http://stackoverflow.com/questions/1804745/get-the-filename-of-a-fileupload-in-a-document-through-javascript
  var file = document.getElementById("admin_file_upload").value;
  var pImage = validImage(file);

  //console.log(file);
  var pIntro = validIntro(document.forms.add_admin_form.admin_intro.value);
  //console.log(pTitle);
  //console.log(pImage);
  //console.log(pIntro);
  if (!pTitle) {
    showError("admin_error_message", "Please enter a valid title.");
  }
  if (!pIntro) {
    showError("admin_error_message", "Please enter a valid introduction between 0 ~ 1000 characters!");
  }
  if (!pImage) {
    showError("admin_error_message", "Please upload a valid image!");
  }
  var isValidAdmin = pTitle && pIntro && pImage;
  return isValidAdmin;
}


//add admin photo
//when file path has already existed, show error! 
function file_exist_error_admin() {
  showError("admin_error_message2", "The file path already exists!");
}

//no mistakes and tell the user the photo has been upload!
function photo_upload_text_admin() {
  showError("admin_error_message2", "Admin added successfully!");
}

//add event photo
//event
function file_exist_error_event() {
  showError("event_error_message2", "The file path already exists!");
}

function photo_upload_text_event() {
  showError("event_error_message2", "Photo uploaded successfully!");
}

//add project photo
//when file path has already existed, show error! 
function file_exist_error() {
  showError("upload_error_message2", "The file path already exists!");
}

//no mistakes and tell the user the photo has been upload!
function photo_upload_text() {
  showError("upload_error_message", "Photo uploaded successfully!");
}

/** ======================================================================================================
    log in part
    ======================================================================================================
*/

/*
  Check valid input password. 0 ~ 255 characters. cannot be empty
*/
function validPassword(text) {
  //var notAllSpaces = /\S/.test(text); 
  var isValidLength = text.length <= 255 && text.length > 0;
  var isValidPassword = strip_tags(text) && isValidLength;
  return isValidPassword;
}

// validate the upload photo form
function validLogin() {
  var uName = validName(document.forms.login_form.username.value);
  if (!uName) {
    showError("login_error_message", "Please enter a valid name.");
  }
  var uPass = validPassword(document.forms.login_form.password.value);
  if (!uPass) {
    showError("login_error_message", "Please enter a valid password");
  }
  var isValidLogin = uName && uPass;
  if (isValidLogin) {
    showError("login_error_message", "Log in successfully");
  }
  //console.log(isValidLogin);
  return isValidLogin;
}

//EDIT PART
// validate edit photo function
function validEditPhoto() {
  var pName = validName(document.forms.edit_photo_form.edit_photo_name.value);
  var pIntro = validIntro(document.forms.edit_photo_form.edit_photo_intro.value);
  //console.log(pName);
  //console.log(pIntro);
  if (!pName) {
    showError("edit_photo_error", "Please enter a valid name.");
  }
  if (!pIntro) {
    showError("edit_photo_error", "Please enter a valid introduction between 0 ~ 1000 characters!");
  }
  var isValidPhoto = pName && pIntro;
  if (isValidPhoto) {
    showError("edit_photo_error", "Photo Edited!");
  }
  return isValidPhoto;
}

// validate edit project function
function validEditProject() {
  var pName = validName(document.forms.edit_project_form.edit_project_name.value);
  var pIntro = validIntro(document.forms.edit_project_form.edit_project_intro.value);
  if (!pName) {
    showError("edit_project_error", "Please enter a valid name.");
  }
  if (!pIntro) {
    showError("edit_project_error", "Please enter a valid introduction between 0 ~ 1000 characters!");
  }
  var isValidProject = pName && pIntro;
  if (isValidProject) {
    showError("edit_project_error", "Project Edited!");
  }
  return isValidProject;
}

// validate add project function
function validateProject() {
  var pName = validName(document.forms.add_project_form.add_project_name.value);
  var pIntro = validIntro(document.forms.add_project_form.add_project_intro.value);
  if (!pName) {
    showError("add_project_message", "Please enter a valid name.");
  }
  if (!pIntro) {
    showError("add_project_message", "Please enter a valid introduction between 0 ~ 1000 characters!");
  }
  var isValidProject = pName && pIntro;
  if (isValidProject) {
    showError("add_project_message", "Project Edited!");
  }
  return isValidProject;
}
// validate change password function
function validChange_pwd() {
  var old_pwd = validName(document.forms.change_pwd_form.old_pwd.value);
  var new_pwd1 = document.forms.change_pwd_form.new_pwd1.value;
  var new_pwd2 = document.forms.change_pwd_form.new_pwd2.value;
  
  //console.log(new_pwd1);
  //console.log(new_pwd2);

  var validPwd = (old_pwd && validName(new_pwd1) && validName(new_pwd2));
  var matchPwd = (new_pwd1 === new_pwd2);
  //console.log(matchPwd);
  if (!validPwd) {
    showError("change_password_error", "Please enter a valid password without tags!");
  }
  
  if (!matchPwd) {
    showError("change_password_error", "New passwords don't match!");
  }

  var isValidPassword = validPwd && matchPwd;
  if (isValidPassword) {
    showError("change_password_error", "Change password submitted!");
  }
  return isValidPassword;
}

// validate add user function
function validateUser() {
  var fName = validRealName(document.forms.add_user_form.first_name.value);
  var lName = validRealName(document.forms.add_user_form.last_name.value);
  var netID = validnetID(document.forms.add_user_form.net_id.value);
  var new_pwd1 = document.forms.add_user_form.user_password1.value;
  var new_pwd2 = document.forms.add_user_form.user_password2.value;

  var validPwd = (validName(new_pwd1) && validName(new_pwd2));
  var matchPwd = (new_pwd1 === new_pwd2);
  //console.log(matchPwd);
  if (!validPwd) {
    showError("add_user_error", "Please enter a valid password without tags!");
  }
  
  if (!matchPwd) {
    showError("add_user_error", "New passwords don't match!");
  }

  if (!fName || !lName) {
    showError("add_user_error", "Please enter a valid name only contains letters!");
  }

  if (!netID) {
    showError("add_user_error", "Please enter a valid net ID only contains letters and numbers!");
  }

  var isValidPassword = validPwd && matchPwd;
  if (isValidPassword) {
    showError("add_user_error", "Add user submitted!");
  }
  return isValidPassword;
}

// Check real name valid, name should only contain letters
function validRealName(name) {
  //Photo name can have characters, spaces, numbers, underscores, dashes and name can't be all spaces
  var isValidLetter = /^[A-Za-z]+$/.test(name);
  var isValidNameLength = (name !== '') && name.length <= 20;
  var isValidName = isValidLetter && isValidNameLength && strip_tags(name);
  return (isValidName);
}

// Check netid , netid should only contain letters and numbers
function validnetID(netid) {
  //Photo name can have characters, spaces, numbers, underscores, dashes and name can't be all spaces
  var isValidnetid = /^[0-9a-zA-Z]+$/.test(netid);
  var isValidLength = (netid !== '') && netid.length <= 20;
  var isValidNetID = isValidnetid && isValidLength && strip_tags(netid);
  return (isValidNetID);
}
/** ======================================================================================================
     event part
    ======================================================================================================
*/
// validate edit event function
function validateEvent() {
  var name = validIntro(document.forms.add_event_form.event_name.value);
  var intro = validIntro(document.forms.add_event_form.event_intro.value);
  var loc = validName(document.forms.add_event_form.event_loc.value);
  //var date = validIntro(document.forms.add_event_form.event_name.value);
  if (!name) {
    showError("event_error_message", "Please enter a valid name.");
  }
  if (!intro) {
    showError("event_error_message", "Please enter a valid introduction between 0 ~ 1000 characters!");
  }
  if (!loc) {
    showError("event_error_message", "Please enter a valid location!");
  }
  var isValidEvent = name && intro && loc;
  if (isValidEvent) {
    showError("event_error_message", "Event Added!");
  }
  return isValidEvent;
}


/** ======================================================================================================
    show error
  ======================================================================================================
*/
// Show error message in field id
function showError(id, errorMessage) { 
   document.getElementById(id).innerHTML = errorMessage;
}

