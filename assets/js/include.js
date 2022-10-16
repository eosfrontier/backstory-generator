document.addEventListener("DOMContentLoaded", function() {

	var editButton = document.querySelector(".edit-backstory-button");
	if (editButton) {
		editButton.addEventListener("click", function() {
			var text = document.querySelector('.text');
			var editor = document.querySelector('#backstory-editor');

			text.style.display = "none";
			editor.style.display = "block";
		});

		tinymce.init({
			selector: '#backstory-textarea',
			menubar: false
		});
	}


	var editButton = document.querySelector(".edit-concept-button");
	if (editButton) {
		editButton.addEventListener("click", function() {
			var text = document.querySelector('.concept-text');
			var editor = document.querySelector('#concept-editor');

			text.style.display = "none";
			editor.style.display = "block";
		});

		tinymce.init({
			selector: '#concept-textarea',
			menubar: false
		});
	}

	window.onbeforeunload = function() {
		if (tinymce.activeEditor.isDirty()) {
			return "Leaving this page will reset the wizard";
		}
	}



});
