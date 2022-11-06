import axios from 'axios';

class Like {
  constructor() {
    if (document.querySelector(".like-box")) {
      axios.defaults.headers.common["X-WP-Nonce"] = universityData.nonce
      this.events();
    }
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
        universityData.root_url + "/wp-json/university/v1/manageLike",
        {
         "professorId": currentLikeBox.getAttribute('data-professor'),
        }
      );
      if (typeof response.data == 'number' ) {
        currentLikeBox.setAttribute("data-exists", "yes");
        let likeCount = parseInt(currentLikeBox.querySelector(".like-count").innerHTML, 10);
        likeCount++;
        currentLikeBox.querySelector(".like-count").innerHTML = likeCount;
      }
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