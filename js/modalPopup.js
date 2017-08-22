//https://www.sitepoint.com/14-jquery-modal-dialog-boxes/
//https://www.w3schools.com/howto/howto_css_modals.asp
// Show delete album form popup 

/**  ==========================================================================
						PHOTOS AND PROJECTS
	===========================================================================*/

function show_upload_photo_popup(id) {
	document.getElementById('upload_photo_popup').style.display = "block";
	document.getElementById('upload_photo_id').value = id;
}

function close_upload_photo_popup() {
	document.getElementById('upload_photo_popup').style.display = "none";
}

function show_edit_project(id) {
	document.getElementById('edit_project_popup').style.display = "block";
	document.getElementById('edit_project_id').value = id;
}

function close_edit_project() {
	document.getElementById('edit_project_popup').style.display = "none";
}

//delete project
function show_delete_project(id) {
	//console.log(id);
	document.getElementById('delete_project_popup').style.display = "block";
	document.getElementById('delete_project_id').value = id;
}

function close_delete_project() {
	document.getElementById('delete_project_popup').style.display = "none";
}

//Edit photo modal
//show
function show_edit_photo(pID) {
	document.getElementById('edit_photo_popup').style.display = "block";
	document.getElementById('edit_photo_id').value = pID;
}
//hide
function close_edit_photo() {
	document.getElementById('edit_photo_popup').style.display = "none";
}

// Delete photo in database modal
//show
function show_delete_photo(pID) {
	document.getElementById('delete_photo_popup').style.display = "block";
	document.getElementById('delete_photo_id').value = pID;
}
// hide
function close_delete_photo() {
	document.getElementById('delete_photo_popup').style.display = "none";
}

// add project in database modal
//show
function show_add_project_popup() {
	document.getElementById('add_project_popup').style.display = "block";
}
// hide
function close_project_popup() {
	document.getElementById('add_project_popup').style.display = "none";
}

/**  ==========================================================================
									User
	===========================================================================*/
function show_delete_user(id) {
	document.getElementById('delete_user_popup').style.display = "block";
	document.getElementById('delete_user_id').value = id;
	console.log(id);
}

// Hide delete album form popup
function close_delete_user() {
	document.getElementById('delete_user_popup').style.display = "none";
}

function show_add_admin(id) {
	document.getElementById('add_admin_popup').style.display = "block";
	document.getElementById('add_admin_id').value = id;
	//console.log(id);
//	console.log(document.forms.add_admin_form.admin_title.value);
//	console.log(document.forms.add_admin_form.admin_intro.value);
//	console.log(document.getElementById("admin_file_upload").value);
}

// Hide delete album form popup
function close_add_admin() {
	document.getElementById('add_admin_popup').style.display = "none";
}

function show_add_user() {
	document.getElementById('add_user_popup').style.display = "block";
}

// Hide delete album form popup
function close_add_user() {
	document.getElementById('add_user_popup').style.display = "none";
}

/**  ==========================================================================
									Event
	===========================================================================*/
function show_add_event() {
	document.getElementById('add_event_popup').style.display = "block";
}

// Hide delete album form popup
function close_add_event() {
	document.getElementById('add_event_popup').style.display = "none";
}
