class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.openButton = document.querySelector(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.events();
  }

  // 2. events
  events() {
    this.openButton.addEventListener('click', () => this.openOverlay());
    this.closeButton.addEventListener('click', () => this.closeOverlay());
    document.body.addEventListener('keydown', this.keyPressDispatcher.bind(this));
    this.isOverlayOpen = false;
  }

  // 3. methods (function, action...)
  openOverlay() {
    this.searchOverlay.classList.add("search-overlay--active");
    document.querySelector("body").classList.add("body-no-scroll");
    this.isOverlayOpen = true;
  }

  closeOverlay() {
    this.searchOverlay.classList.remove("search-overlay--active");
    document.querySelector("body").classList.remove("body-no-scroll");
    this.isOverlayOpen = false;
  }

  keyPressDispatcher(e) {
    /* Check for Key code
    console.log(e.keyCode); */

    /* 83 is S key */
    if(e.keyCode == 83 && !isOverlayOpen){
      this.openOverlay();
    }

    /* 27 is ESC key */
    if(e.keyCode == 27 && isOverlayOpen){
      this.closeOverlay();
    }
  }
}

export default Search
