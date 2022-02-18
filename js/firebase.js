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


//vue app component
app.component('chat_list-component',{
    
    props: ['name','counter','chat_imgs', 'owner_name', 'profile_name'],
    
    template: `
    <li class="clearfix" @click="chat_person();">
    
        <img :src='img_url_ind' alt="avatar" style = 'width: 50px; height : 50px; border-radius: 50%;'/>
        <div class="about">
            <div class="names">Dog Name : {{name}}</div>
            <div class="owner_name">Username : {{owner_name}}</div>
        </div>
        <div class = "notification" :id="this.owner_name" v-show ="notification(owner_name,profile_name)">
            <i class='bell fa fa-bell faa-ring'></i>
        </div>
    </li>
    `,

    data(){
        return{
            //img_url_ind: "https://cdn2.thedogapi.com/images/Hkxk4ecVX.jpg",
            img_url_ind: this.chat_imgs,
            show: false,
        }
        
    },
    methods: {
        
        chat_person(){
            //console.log(this.name)

            document.getElementById("chat_window").style.display = "inline"
            document.getElementById("default_chat_page").style.display = "none"
            //when in computer view, hide people_list
            if (window.innerWidth < 400) {
                $("#people_list").hide();
            }
            
            //update name and image of who you are chatting with
            this.$emit('change', [this.name, this.img_url_ind,this.owner_name])
        },
        
        notification(cn, pn){
            //console.log(cn)
            
            msgRef.on("value", function(snapshot) {
                //console.log(snapshot.val());
                for (key in snapshot.val()){
                    //console.log(snapshot.val()[key].chat_name)
                    if (cn == snapshot.val()[key].name && snapshot.val()[key].receiverhasRead == false && profile_name == snapshot.val()[key].chat_name){
                        document.getElementById(cn).style.display = 'inline'
                        break
                    }
                }
            });
        },
    },
    mounted(){

    }
})

app.mount("#app");


const msgScreen = document.getElementById("messages"); //the <ul> that displays all the <li> msgs
const msgForm = document.getElementById("messageForm"); //the input form
const msgInput = document.getElementById("msg-input"); //the input element to write messages
const people = document.getElementById("people"); //people_list

var profile_name = document.getElementById('profile_text').innerText
profile_name = profile_name.slice(4,profile_name.length-2)
//console.log(profile_name)

people.addEventListener('click', updateMessage);

// when submit is clicked
msgForm.addEventListener('submit', sendMessage);
// when enter is clicked
$("#msg-input").keypress(function (e) {
    if(e.which === 13 && !e.shiftKey) {
        sendMessage(e);
    }
});

function getCurrentTime() {
    return new Date().toLocaleTimeString().
            replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
}

function getCurrentDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    return today = mm + '/' + dd + '/' + yyyy;
}

function sendMessage(e){
    e.preventDefault();
    const text = msgInput.value;
    const time = getCurrentTime();
    const date = getCurrentDate();
    
    const chat_name = document.getElementById('chatname').innerText
    //console.log('chat name',chat_name)

        if(!text.trim()) return ""; //no msg submitted
        const msg = {
            name: profile_name,
            text: text, 
            time: time,
            date: date,
            chat_name: chat_name,
            receiverhasRead: false,
        };
        
        msgRef.push(msg);
        msgInput.value = "";
}

function updateMessage() {
    //console.log('in')
    var msg = "";

    const updateMsgs = data =>{
        const {name, chat_name , text, time , date, receiverhasRead} = data.val(); //get name and text
    
        const cn = document.getElementById('chatname').innerText
        const stored_id = data.key
        //console.log(stored_id)

        flag = false
        
        let text_trim = text.trimEnd()

        if(text_trim.includes('\n')){

            var text_arr = text.split("\n")
            flag = true
        }

        if (name == profile_name && cn == chat_name){
            msg += `
            <li class="clearfix">
                <div class="message-data align-right">
                    <span class="message-data-time">${time}, ${date}</span> &nbsp; &nbsp;
                    <span class="message-data-name">${profile_name}</span> <i class="fa fa-circle me"></i>
                </div>

                <!-- deletion of message -->
                
                <div class="message other-message float-right">
                    <i class="cross fa fa-times" id='${stored_id}' onclick="delete_msg(this.id)"></i>
                
            `
            if (flag){
                for(t of text_arr){
                    if (t==""){
                        msg+= "<br>"
                    }else{
                        msg+=
                        `
                        <div>${t}</div>
                        `
                    }
                    
                }    
            }else{
                msg+=
                    `
                    <div>${text}</div>
                    `
            }
            
            msg += `
                </div>
            </li>
            `
        }else if(chat_name == profile_name && name == cn){
            msg +=`
            <li>
                <div class="message-data">
                    <span class="message-data-name"><i class="fa fa-circle talker"></i></span>
                    <span>${cn}</span>
                    <span class="message-data-time">${time}, ${date}</span>
                </div>
                <div class="message my-message">
                `
            if (flag){
                for(t of text_arr){
                    if (t==""){
                        msg+= "<br>"
                    }else{
                        msg+=
                        `
                        <div>${t}</div>
                        `
                    }
                    
                }    
            }else{
                msg+=
                    `
                    <div>${text}</div>
                    `
            }
            msg+=`
                </div>
            </li>
            `
        }else{
            msg += ''
        }

    msgScreen.innerHTML = msg; //add the <li> message to the chat window

    //auto scroll to bottom
    document.getElementById("chat-history").scrollTop = document.getElementById("chat-history").scrollHeight;
    
    //checking if user has read message
    if (receiverhasRead == false && cn==name && document.getElementById("chat_window").style.display == "inline" && chat_name == profile_name ){
        //console.log("receiver read")
        //to update read to true
        const updates = {
            receiverhasRead: true,
        };
        
        msgRef.child(stored_id).update(updates)
        document.getElementById(cn).style.display = "none"
        }
    
    }
    msgRef.on('child_added', updateMsgs);
}

// deleting of message
function delete_msg(key){
    //console.log(key)
    msgRef.child(key).remove();
    updateMessage();
}

// to update other user chat
msgRef.on('child_removed', function(oldChildSnapshot) {
    //console.log('Child '+oldChildSnapshot.key+' was removed');
    updateMessage();
});

// esc button
$(document).keyup(function(e) {
    if (e.key === "Escape") {
        document.getElementById("chat_window").style.display = "none"
        document.getElementById("default_chat_page").style.display = "flex"

        // when in iphone view, show people_list
        if (window.innerWidth < 1000) {
            $("#people_list").show();
        }
    }
});

//back button clicked
function back(){
    document.getElementById("chat_window").style.display = "none"
    document.getElementById("default_chat_page").style.display = "flex"
    // when in iphone view, show people_list
    if (window.innerWidth < 1000) {
        $("#people_list").show();
    }
}

