/* display preview photo */

let owner_pic = document.getElementById("uploadFile1")
owner_pic.addEventListener("change", showOwnerPreview)

function showOwnerPreview() {
  console.log("====showOwnerPreview()=======")
  photo1.src = URL.createObjectURL(event.target.files[0]);
  photo1.style.width = '130px'
  photo1.style.height = '130px'

}

let dog_pic = document.getElementById("uploadFile2")
dog_pic.addEventListener("change", showDogPreview)



function showDogPreview() {
  console.log("====showDogPreview()=======")
  
  photo2.src = URL.createObjectURL(event.target.files[0]);
  photo2.style.width = '130px'
  photo2.style.height = '130px'
  
  
}

// Created By CodingNepal
const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");
const prevBtnFourth = document.querySelector(".prev-3");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;


// click to go 2nd page
nextBtnFirst.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  document.getElementById("my-header").innerText = 'Next, tell us some basics about your dog!'
});

// click to go 3rd page
nextBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  document.getElementById("my-header").innerText = 'Almost there! Please tell us more details about your dog!'

});

// click to go final page
nextBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
  document.getElementById("my-header").innerText = "Yay, here is a summary of your profile! Click submit to complete profile setup"

});

submitBtn.addEventListener("click", function(){
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});

// go back to 1st page
prevBtnSec.addEventListener("click", function(event){
  console.log("===previous button clicked======")
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
  document.getElementById("my-header").innerText = "Hi, tell us a bit about yourself"
});

// go back to 2nd page
prevBtnThird.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
  document.getElementById("my-header").innerText = 'Next, tell us some basics about your dog!'

});

// go back to 3rd page
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
  document.getElementById("my-header").innerText = 'Almost there! Please tell us more details about your dog!'

});


/* display summary */

/* get owner details */

let summary_btn = document.getElementById("next_btn")

summary_btn.addEventListener("click", getSummary)

function getSummary() {
  /* owner details */
  let fname = document.getElementById("fname").value
  let lname = document.getElementById("lname").value
  let owner_name = fname + " " + lname
  let owner_gender = document.getElementById("owner_gender").value
  let owner_dob = document.getElementById("dob1").value
  let owner_img = document.getElementById("photo1").src

  /* dog details */
  let dog_name = document.getElementById("dog_name").value
  let dog_gender = document.getElementById("dog_gender").value
  let dog_dob = document.getElementById("dob2").value
  let dog_img = document.getElementById("photo2").src
  let breed = document.getElementById("breed").value
  let weight = document.getElementById("dog_weight").value
  let fav_place = document.getElementById("favplace").value
  let personality = document.getElementsByName("personality[]")
  let personality_array = []
  for(let i = 0; i < personality.length ; i ++) {
    if(personality[i].checked) {
      personality_array.push(personality[i].value)
    }
  }

  let personality_str = personality_array.join(", ")
  let summary_str =``
  summary_str += `
<div class = 'col-md-4'>
  <div class="card border-0 h-100" style="width: 18rem;">
      <img src="${owner_img}" class="card-img-top rounded rounded-circle mx-auto d-flex"   style="width: 80px; height: 80px;">
      <div class="card-body">
        <h5 class="card-title">${owner_name}</h5>
        <p class="card-text">Gender: ${owner_gender} <br> Date of Birth: ${owner_dob}</p>
      </div>
  </div>
</div>
<div class = 'col-md-4'>
  <div class="card border-0 h-100" style="width: 18rem;">
      <img src="${dog_img}" class="card-img-top rounded rounded-circle mx-auto d-flex"   style="width: 80px; height: 80px;">
      <div class="card-body">
        <h5 class="card-title">${dog_name}</h5>
        <p class="card-text">Gender: ${dog_gender} <br> Date of Birth: ${dog_dob} <br>
        Breed: ${breed} <br> Weight: ${weight} <br> Personality Type: ${personality_str}
        <br> Favourite Places: ${fav_place}</p>
      </div>
  </div>
</div>
`

  document.getElementById("summary_box").innerHTML = summary_str


}

