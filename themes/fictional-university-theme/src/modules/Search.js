class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.resultsDiv = document.querySelector("#search-overlay__results");
    this.openButton = document.querySelector(".js-search-trigger").parentElement;
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector('#search-term');
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.typingTimer;
    this.events();
  }

  // 2. events
  events() {
    this.openButton.addEventListener('click', () => this.openOverlay());
    this.closeButton.addEventListener('click', () => this.closeOverlay());
    this.searchField.addEventListener("keydown", this.typingLogic.bind(this));
    document.body.addEventListener('keydown', this.keyPressDispatcher.bind(this));
  }

  // 3. methods (function, action...)
  openOverlay() {
    this.isOverlayOpen = true;
    this.searchOverlay.classList.add("search-overlay--active");
    document.querySelector("body").classList.add("body-no-scroll");
  }

  closeOverlay() {
    this.isOverlayOpen = false;
    this.searchOverlay.classList.remove("search-overlay--active");
    document.querySelector("body").classList.remove("body-no-scroll");
  }

  keyPressDispatcher(e) {
    /* Check for Key code
    console.log(e.keyCode); */

    /* 83 is S key */
    if(e.keyCode == 83 && !this.isOverlayOpen){
      this.openOverlay();
    }

    /* 27 is ESC key */
    if(e.keyCode == 27 && this.isOverlayOpen){
      this.closeOverlay();
    }
  }

  typingLogic() {
    clearTimeout(this.typingTimer);
    if(!this.isSpinnerVisible) {
      this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
      this.isSpinnerVisible = true;
    }
    this.typingTimer = setTimeout(this.getResults.bind(this), 2000);
  }

  getResults() {
    this.resultsDiv.innerHTML = "Imagine real search results here";
    this.isSpinnerVisible = false;
  }
}

export default Search