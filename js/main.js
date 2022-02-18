// animation
document.addEventListener('DOMContentLoaded', () => {
	anime({
		targets: '#logo',
		translateX: [-300, 0],
        easing: 'easeOutExpo'
	})

    anime({
		targets: '.headings, .card, #playmate_btn',
		translateY: [-400, 0],
		easing: 'easeOutExpo',
        duration: 1500,
		delay: 300,
		opacity: [0, 1],
	})



})

// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyAf79qoKbHQik63_KtJir9tJRO0K_Hvnvo",
    authDomain: "dogpal-chat.firebaseapp.com",
    projectId: "dogpal-chat",
    storageBucket: "dogpal-chat.appspot.com",
    messagingSenderId: "40363491944",
    appId: "1:40363491944:web:d7eca5cc311d587c1371dd",
    measurementId: "G-8WMVJHL9CF",
    databaseURL: "https://dogpal-chat-default-rtdb.asia-southeast1.firebasedatabase.app" 
};

firebase.initializeApp(firebaseConfig);
const db = firebase.database();
//console.log(firebase.database)

//to store data in the msgs folder by creating a reference in database
const msgRef = db.ref("/msgs"); 


// retrieve user info when they are logged in
const app = Vue.createApp({
    data() {
        return {
            username: '',
            img_url: '',
            login: false,
            contact_name: '',
            contact_email: '',
            contact_text: '',
            check: ''
        }
    },

    created: function() {

        let url = "authenticate.php"
            
        axios.get(url)
        .then(response => {
            let data = response.data
            this.username  = data.username
            this.img_url = data.img_src
            if(data.username && data.img_src) {
                this.login = true

            }
            else {
                this.login = false

            }

            
        })
        .catch(error => {
            console.log(error.message)
        })
    },

    methods: {
        checkInput() {
            if(this.contact_name.length > 0 &&this.contact_email.length > 0 & this.contact_text.length > 0 ) {
                this.check = true
            }
            else {
                this.check = false
            }

            return this.check
            

        },
        submitQuery() {
            this.contact_name = ''
            this.contact_email = ''
            this.contact_text = ''
            
        },
        notification(pn){
            //console.log(cn)
            
            msgRef.on("value", function(snapshot) {
                //console.log(snapshot.val());
                for (key in snapshot.val()){
                    //console.log(snapshot.val()[key].chat_name)
                    if (snapshot.val()[key].receiverhasRead == false && pn == snapshot.val()[key].chat_name){
                        document.getElementById("notification").style.display = 'inline'
                        break
                    }
                }
            });
        },
    }
})

// create component for testimonial
app.component("testimonial-component",{
	props: ['img_src', 'text', 'person'],
	template: ` <div class = 'row justify-content-center text-center'>
	<h3 class = 'mt-3 headings'>Testimonials</h3>
	<div class = 'col-md-12 mt-5'>
		<img :src = 'img_src' class = 'rounded-circle mb-4' style="width: 100px; height: 100px">
	</div>
	<div class = 'col-md-6 mb-3'>
		<p class = 'fst-italic'>{{text}}</p>
		<span class = 'user'>{{person}}</span>
	</div>
</div>`

})

// create component for modal pop-up when contact form is submitted
app.component("modal-component", {
    template: `<div class="modal fade" id="contact_success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thank you for contacting DogPals!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        Your enquiry has been received and you will receive a response in 2-3 working days. Have a great day!
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>`
})


app.mount("#app")



/* scroll to top function */ 

let scroll_button = document.getElementById("scrollBtn")

scroll_button.addEventListener("click", scrollToTop)
window.onscroll = function() { scrollFunction() }

function scrollFunction() {
	if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    	scroll_button.style.display = "block"
	} 
	else {
    scroll_button.style.display = "none"
}
}



function scrollToTop() {
	document.body.scrollTop = 0
	document.documentElement.scrollTop = 0
}


