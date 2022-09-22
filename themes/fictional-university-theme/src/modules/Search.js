class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.openButton = document.querySelector(".js-search-trigger");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector('#search-term');
    this.isOverlayOpen = false;
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
    console.log("typing in search field");
  }
}

export default Search
