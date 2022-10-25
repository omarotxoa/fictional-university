import $ from 'jquery';

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.resultsDiv = document.querySelector("#search-overlay__results");
    this.openButton = document.querySelectorAll(".fa-search");
    this.closeButton = document.querySelector(".search-overlay__close");
    this.searchOverlay = document.querySelector(".search-overlay");
    this.searchField = document.querySelector('#search-term');
    this.isOverlayOpen = false;
    this.isSpinnerVisible = false;
    this.previousValue;
    this.typingTimer;
    this.events();
  }

  // 2. events
  events() {
    this.openButton.forEach((button) => {
      button.addEventListener("click", () => this.openOverlay());
    });
    this.closeButton.addEventListener("click", () => this.closeOverlay());
    this.searchField.addEventListener("keyup", this.typingLogic.bind(this));
    document.body.addEventListener('keydown', this.keyPressDispatcher.bind(this));
  }

  // 3. methods (function, action...)
  openOverlay() {
    this.isOverlayOpen = true;
    this.searchOverlay.classList.add("search-overlay--active");
    document.querySelector("body").classList.add("body-no-scroll");
    this.searchField.value = '';
  }

  closeOverlay() {
    this.isOverlayOpen = false;
    this.searchOverlay.classList.remove("search-overlay--active");
    document.querySelector("body").classList.remove("body-no-scroll");
  }

  keyPressDispatcher(e) {
    /* Check for Key code
    console.log(e.keyCode); */

    /* Used to check if user is typing into an input/textarea */
    let activeInput = document.querySelector('input');
    let activeTextarea = document.querySelector('textarea');

      /* 83 = S Key. Checks that user is not typing in an input to fire off the keybind */
      if(e.keyCode == 83 && !this.isOverlayOpen && activeInput != document.activeElement && activeTextarea != document.activeElement){
        this.openOverlay();
      }

    /* 27 is ESC key */
    if(e.keyCode == 27 && this.isOverlayOpen){
      this.closeOverlay();
    }
  }

  typingLogic() {
    if(this.searchField.value != this.previousValue) {
      clearTimeout(this.typingTimer);
      if (this.searchField.value != '') {
        if(!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 500);
      } else {
        this.resultsDiv.innerHTML = '';
        this.isSpinnerVisible = false;
      }
    }
    this.previousValue = this.searchField.value;
  }

  getResults() {
    const resultsDiv = document.querySelector("#search-overlay__results");

    $.getJSON(universityData.root_url + '/wp-json/university/v1/search?term=' + this.searchField.value, (results) => {
      this.resultsDiv.innerHTML = `
        <div class="row">
          <div class="one-third">
            <h2 class="search-overlay__section-title">General Information</h2>
            ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search'}
            ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
            ${results.generalInfo.length ? '</ul>' : '</p>'}
          </div>
          <div class="one-third">
            <h2 class="search-overlay__section-title">Programs</h2>
            ${results.programs.length ? '<ul class="link-list min-list">' : `<p>No Programs match that search. <a href="${universityData.root_url}/programs">View all Programs</a>`}
            ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
            ${results.programs.length ? '</ul>' : '</p>'}

            
            <h2 class="search-overlay__section-title">Professors</h2>
            ${results.professors.length ? '<ul class="professor-cards">' : `<p>No Professors match that search.`}
            ${results.professors.map(item => `
              <li class="professor-card__list-item">
                <a class="professor-card" href="${item.permalink}">
                  <img class="professor-card__image" src="${item.image}" alt="">
                  <span class="professor-card__name">${item.title}</span>
                </a>
              </li>`).join('')}
            ${results.professors.length ? '</ul>' : '</p>'}


          </div>
          <div class="one-third">
            <h2 class="search-overlay__section-title">Campuses</h2>
            ${results.campuses.length ? '<ul class="link-list min-list">' : `<p>No Campuses match that search. <a href="${universityData.root_url}/campuses">View all Campuses</a>`}
            ${results.campuses.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
            ${results.campuses.length ? '</ul>' : '</p>'}
            <h2 class="search-overlay__section-title">Events</h2>
          </div>
        </div>`;
      this.isSpinnerVisible = false;
    });
  }
}

export default Search
