import "../css/style.scss"

// Our modules / classes
import MobileMenu from "./modules/MobileMenu"
import HeroSlider from "./modules/HeroSlider"
import Search from "./modules/Search"
import MyNotes from "./modules/MyNotes"
import Like from "./modules/Like"

// Instantiate a new object using our modules/classes
const mobileMenu = new MobileMenu()
const heroSlider = new HeroSlider()
const liveSearch = new Search()
const myNotes = new MyNotes()
const like = new Like()


// const openSearch = document.querySelector(".fa-search");
// const searchOverlay = document.querySelector(".search-overlay");

// console.log(openSearch);

// document.addEventListener('click', function(e){
//   searchOverlay.classList.add("search-overlay--active");
//   console.log(e.target);
// });