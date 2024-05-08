document.addEventListener( "DOMContentLoaded", function() {
	// function load_editor( location ) {
	// 	tinymce.init( {
	// 		selector: location,
	// 		menubar: false,
	// 		skin: 'oxide-dark',
	// 		content_css: 'dark',
	// 		toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | outdent indent'
	// 	} );
	// }
	$('#existing-backstory-textarea').trumbowyg({
    autogrow: true
});

	var editButtons = document.querySelectorAll( ".concept_change-request-button" );
	if ( editButtons ) {
		editButtons.forEach( ( editButton ) => {
			editButton.addEventListener( "click", function() {
				const id = this.id.replace( "concept-changes-button-", "" );
				const approveForm = document.querySelector( "#concept-approve-" + id );
				const conceptChangesForm = document.querySelector( "#concept-changes-" + id );

				$("#concept_changes-form-" + id ).trumbowyg();
				this.style.display = "none";
				approveForm.style.display = "none";
				conceptChangesForm.style.display = "block";

				// var text = document.querySelector( '.text' );
				// var editor = document.querySelector( '#backstory-editor' );
				// var submitBackstory = document.querySelector( '.submit-backstory' );
				// editor.style.display = "block";
				// text.style.display = "none";
				// submitBackstory.style.display = "none";
			} );
		} );
		//load_editor( '#backstory-textarea' );
	}


	var tabButtons = document.querySelectorAll( ".tab-list button" );

	tabButtons.forEach( ( button ) => {
		button.addEventListener( "click", function( e ) {
			var attribute = this.getAttribute( "data-tab" );

			if ( e.target.className !== "active" ) {
				var activeTab = document.querySelector( ".tab.active" );
				var activeButton = document.querySelector( ".tab-list button.active" );
				var newTab = document.querySelector( ".tab[data-tab='" + attribute + "']" )

				activeTab.classList.remove( "active" );
				activeButton.classList.remove( "active" );

				this.classList.add( "active" );
				newTab.classList.add( "active" );
			}
		} );
	} );

	var contentToggles = document.querySelectorAll( ".mouse_hover" );

	contentToggles.forEach( ( button ) => {
		button.addEventListener( "click", function( e ) {
			if ( e.target.classList.contains( "active" ) ) {
				this.classList.remove( "active" );
				button.nextElementSibling.classList.remove( "show" );
			} else {
				this.classList.add( "active" );
				button.nextElementSibling.classList.add( "show" );
			}
		} )
	} );
} );
