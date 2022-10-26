import $ from 'jquery';

class MyNotes {
  constructor() {
    this.events();
  }
  events() {
    $(".delete-note").on("click", this.deleteNote);
    $(".edit-note").on("click", this.editNote.bind(this));
    $(".update-note").on("click", this.updateNote.bind(this));
  }

  // Methods
  deleteNote(e) {
    var thisNote = $(e.target).parents("li");
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
      },
      url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
      type: 'DELETE',
      success: (response) => {
        thisNote.slideUp();
        console.log("Congrats, success!");
        console.log(response);
      },
      error: (response) => {
        console.log("Sorry, not a success");
        console.log(response);
      }
    });
  }
  editNote(e) {
    var thisNote = $(e.target).parents("li");
    if (thisNote.data("state") == 'editable') {
      this.makeNoteReadOnly(thisNote);
    } else {
      this.makeNoteEditable(thisNote);
    }
  }
  updateNote(e) {
    var thisNote = $(e.target).parents("li");
    var ourUpdatedPostData = {
      'title': thisNote.find(".note-title-field").val(),
      'content': thisNote.find(".note-body-field").val(),
    }
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
      },
      url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
      type: 'POST',
      data: ourUpdatedPostData,
      success: (response) => {
        this.makeNoteReadOnly(thisNote);
        console.log("Congrats, success!");
        console.log(response);
      },
      error: (response) => {
        console.log("Sorry, not a success");
        console.log(response);
      }
    });
  }

  makeNoteEditable(thisNote) {
    thisNote.find(".edit-note").html('<i class="fa fa-times" aria-hidden="true">Cancel</i>');
    thisNote.find(".note-title-field, .note-body-field").removeAttr('readonly').addClass("note-active-field");
    thisNote.find(".update-note").addClass("update-note--visible");
    thisNote.data("state", "editable");
  }
  makeNoteReadOnly(thisNote) {
    thisNote.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true">Edit</i>');
    thisNote.find(".note-title-field, .note-body-field").attr('readonly', 'readonly').removeClass("note-active-field");
    thisNote.find(".update-note").removeClass("update-note--visible");
    thisNote.data("state", "cancel");
  }
}

export default MyNotes;