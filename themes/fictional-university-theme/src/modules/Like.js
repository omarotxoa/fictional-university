import axios from 'axios';

class Like {
  constructor() {
    this.events();
  }
  events() {
    document.querySelector(".like-box").addEventListener("click", (e) => {
      this.likeBoxClick(e);
    })
  }

  likeBoxClick(e) {
    let currentLikeBox = e.target;
    console.log(currentLikeBox);

    if (currentLikeBox.classList.contains("like-count") || currentLikeBox.classList.contains("fa")) {
      currentLikeBox = currentLikeBox.parentElement
    }

    if (currentLikeBox.getAttribute("data-exists") == "yes") {
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }

  async createLike(currentLikeBox) {
    try {
      const response = await axios.post(
        universityData.root_url + "/wp-json/university/v1/manageLike"
      );
      console.log(response.data);
    } catch(e) {
      console.log(e);
    }
  }

  async deleteLike(currentLikeBox) {
    try {
      const response = await axios.delete(
        universityData.root_url + "/wp-json/university/v1/manageLike"
      );
      console.log(response.data);
    } catch(e) {
      console.log(e);
    };
  }
}

export default Like;