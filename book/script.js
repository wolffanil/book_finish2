const btnCat = document.querySelector(".nav__catalog");
const windowCatalog = document.querySelector(".catalog__overview");
const closeCatalog = document.querySelector(".catalog__close");
const userIcon = document.querySelector(".nav__user");
const overview = document.querySelector(".overview");
const searchBtn = document.querySelector(".nav__search__icon");
const input = document.querySelector(".nav__search__input");
const select = document.querySelector(".admin__select");
const mainContainer = document.querySelector(".main__container");
const catalog = document.querySelector(".overview__catalog");
const editBook = document.querySelector(".admin__overview");
const closeEdit = document.querySelector(".admin__cancel");
const btnNewBook = document.querySelector('.admin__add');

if (select) {
  select.addEventListener("change", () => {
    select.style.color = "black";
  });
}

if (btnCat) {
  btnCat.addEventListener("click", () => {
    windowCatalog.style.display = "block";
    // catalog.classList.remove('overview__catalog__hidden');
    catalog.classList.add("overview__catalog__active");
    catalog.style.right = "0";
    document.body.style.overflow = "hidden";
  });
}

if (closeCatalog) {
  closeCatalog.addEventListener("click", () => {
    windowCatalog.style.display = "none";
    document.body.style.overflow = "scroll";
  });

  windowCatalog.addEventListener("click", () => {
    windowCatalog.style.display = "none";
    document.body.style.overflow = "scroll";
  });
}

if (userIcon) {
  userIcon.addEventListener("click", () => {
    if (overview.style.display === "block") {
      overview.style.display = "none";
    } else {
      overview.style.display = "block";
    }

    if (overview.style.display === "block") {
      mainContainer.addEventListener("click", () => {
        overview.style.display = "none";
      });
    }
  });

  // window.addEventListener('click', () => {
  //   if (overview.style.display === "block") {
  //     overview.style.display = "none";
  // };
  // });
}

if (searchBtn) {
  searchBtn.addEventListener("click", () => {
    if (input.value.length > 2) {
      location.assign(`index.php?search=${input.value}`);
    }
  });

  window.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
      let userInput = input.value;
      let characterCount = userInput.length;
      if (characterCount > 2) {
        location.assign(`index.php?search=${input.value}`);
        // location.assign(`${window.location.href}/admin.php`);
      }
    }
  });
}

if (editBook) {
  const href = window.location.href;
  if (href.includes("?edit=")) {
    editBook.style.display = "flex";
    document.body.style.overflow = "hidden";
  }
}

if (closeEdit) {
  closeEdit.addEventListener("click", () => {
    editBook.style.display = "none";
    document.body.style.overflow = "scroll";
    location.assign("reset.php");
  });
}

if(btnNewBook) {
  btnNewBook.addEventListener('click', () => {
    editBook.style.display = "flex";
    document.body.style.overflow = "hidden";
  })
}
