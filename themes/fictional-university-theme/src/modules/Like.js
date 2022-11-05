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
      this.deleteLike();
    } else {
      this.createLike();
    }
  }

  createLike() {
    alert('click to add from create like function');
  }

  deleteLike() {
    alert('clicked to delete from deletelike function');
  }
}

export default Like;