document.addEventListener( "DOMContentLoaded", function() {

	function load_editer( location ) {
		tinymce.init( {
			selector: location,
			menubar: false,
			skin: 'oxide-dark',
			content_css: 'dark',
			toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
		} );
	}

	var editButton = document.querySelector( ".edit-backstory-button" );
	if ( editButton ) {
		editButton.addEventListener( "click", function() {
			var text = document.querySelector( '.text' );
			var editor = document.querySelector( '#backstory-editor' );
			var submitBackstory = document.querySelector( '.submit-backstory' );
			editor.style.display = "block";
			text.style.display = "none";
			submitBackstory.style.display = "none";
		} );

		load_editer( '#backstory-textarea' );
	}

	var editButton = document.querySelector( ".edit-concept-button" );
	if ( editButton ) {
		editButton.addEventListener( "click", function() {
			var text = document.querySelector( '.concept-text' );
			var editor = document.querySelector( '#concept-editor' );
			var submitBackstory = document.querySelector( '.submit-backstory' );

			text.style.display = "none";
			submitBackstory.style.display = "none";
			editor.style.display = "block";
		} );

		load_editer( '#concept-textarea' );
	}

	load_editer( '#concept-textarea_new' );

	window.onbeforeunload = function() {
		if ( tinymce.activeEditor.isDirty() ) {
			return "Leaving this page will reset the wizard";
		}
	}
} );
