//PAGE ANIMATION
const banner = document.querySelector(".mySlides");
const navbar = document.querySelector("header");
const navButton = document.querySelectorAll(".navButton");
const card = document.querySelectorAll(".card");

const tl = new TimelineMax();

tl.fromTo(
  navbar,
  0.6,
  { width: "0%", opacity: "0" },
  { width: "100%", opacity: "1", ease: Power2.easeInOut }
)
  .fromTo(
    banner,
    0.5,
    { left: "-100px", opacity: "0" },
    { left: "0px", opacity: "1", ease: Power2.easeInOut }
  )
  .fromTo(navButton, 0.3, { opacity: "0" }, { opacity: "1" })
  .fromTo(
    card,
    0.3,
    { x: "-10", y: "-10", opacity: "0" },
    { x: "0", y: "0", opacity: 1, ease: Power2.easeInOut },
    "-=0.3"
  );

// tl.fromTo(
//   banner,
//   1,
//   { width: "0%" },
//   { width: "100%", ease: Power2.easeInOut }
// );

//PAGE FUNCTIONALITY

const productImage = document.querySelectorAll(".product img");
const productHeader = document.querySelectorAll(".product.header h2");

for (let items of productImage) {
  items.addEventListener("mouseover", (event) => {
    //console.log(event.target.parentElement.parentElement);
    event.target.parentElement.parentElement.style.transform = "scale(1.012)";
  });
}
for (let items of productImage) {
  items.addEventListener("mouseout", (event) => {
    event.target.parentElement.parentElement.style.transform = "";
  });
}

for (let header of productHeader) {
  header.addEventListener("mouseover", (event) => {
    //console.log(event.target.parentElement.parentElement);
    event.target.parentElement.parentElement.style.transform = "scale(1.012)";
  });
}
for (let header of productHeader) {
  header.addEventListener("mouseout", (event) => {
    event.target.parentElement.parentElement.style.transform = "";
  });
}

const searchFunction = () => {
  let filter = document.getElementById("consoleSearch").value.toUpperCase();

  // Mengubah search bar yang satunya lagi:
  document.getElementById("consoleSearchPhone").value =
    document.getElementById("consoleSearch").value;

  const productHeader = document.querySelectorAll(".product.header");
  let producth2, itemName;
  for (let i = 0; i < productHeader.length; i++) {
    producth2 = productHeader[i].getElementsByTagName("h2")[0];
    itemName = producth2.textContent || producth2.innerText;
    // console.log(productHeader[i].parentElement.parentElement);
    //console.log(itemName.toUpperCase().indexOf(filter));
    if (itemName.toUpperCase().indexOf(filter) > -1) {
      productHeader[i].parentElement.style.display = "";
    } else {
      productHeader[i].parentElement.style.display = "none";
    }
  }
};

const searchFunction2 = () => {
  let filter = document
    .getElementById("consoleSearchPhone")
    .value.toUpperCase();

  // Mengubah search bar yang satunya lagi:
  document.getElementById("consoleSearch").value =
    document.getElementById("consoleSearchPhone").value;

  const productHeader = document.querySelectorAll(".product.header");
  let producth2, itemName;

  for (let i = 0; i < productHeader.length; i++) {
    producth2 = productHeader[i].getElementsByTagName("h2")[0];
    itemName = producth2.textContent || producth2.innerText;
    if (itemName.toUpperCase().indexOf(filter) > -1) {
      productHeader[i].parentElement.style.display = "";
    } else {
      productHeader[i].parentElement.style.display = "none";
    }
  }
};

const showSlides = () => {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }
  slides[slideIndex - 1].style.display = "block";
  setTimeout(showSlides, 3000); //KASIH TAU TEMEN ADA YANG BERUBAH
};
let slideIndex = 0;
showSlides();

const openSearch = () => {
  const searchContainerPhone = document.getElementById("searchPhoneContainer");
  searchContainerPhone.style.top = "auto";
  searchContainerPhone.style.zIndex = "99999";
};

const closeSearch = () => {
  document.getElementById("searchPhoneContainer").style.top = "-1000px";
};
