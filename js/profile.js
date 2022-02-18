
const dog_array =  [
    "Affenpinscher",
    "Afghan Hound",
    "African Hunting Dog",
    "Airedale Terrier",
    "Akbash Dog",
    "Akita",
    "Alapaha Blue Blood Bulldog",
    "Alaskan Husky",
    "Alaskan Malamute",
    "American Bulldog",
    "American Bully",
    "American Eskimo Dog",
    "American Eskimo Dog (Miniature)",
    "American Foxhound",
    "American Pit Bull Terrier",
    "American Staffordshire Terrier",
    "American Water Spaniel",
    "Anatolian Shepherd Dog",
    "Appenzeller Sennenhund",
    "Australian Cattle Dog",
    "Australian Kelpie",
    "Australian Shepherd",
    "Australian Terrier",
    "Azawakh",
    "Barbet",
    "Basenji",
    "Basset Bleu de Gascogne",
    "Basset Hound",
    "Beagle",
    "Bearded Collie",
    "Beauceron",
    "Bedlington Terrier",
    "Belgian Malinois",
    "Belgian Tervuren",
    "Bernese Mountain Dog",
    "Bichon Frise",
    "Black and Tan Coonhound",
    "Bloodhound",
    "Bluetick Coonhound",
    "Boerboel",
    "Border Collie",
    "Border Terrier",
    "Boston Terrier",
    "Bouvier des Flandres",
    "Boxer",
    "Boykin Spaniel",
    "Bracco Italiano",
    "Briard",
    "Brittany",
    "Bull Terrier",
    "Bull Terrier (Miniature)",
    "Bullmastiff",
    "Cairn Terrier",
    "Cane Corso",
    "Cardigan Welsh Corgi",
    "Catahoula Leopard Dog",
    "Caucasian Shepherd (Ovcharka)",
    "Cavalier King Charles Spaniel",
    "Chesapeake Bay Retriever",
    "Chinese Crested",
    "Chinese Shar-Pei",
    "Chinook",
    "Chow Chow",
    "Clumber Spaniel",
    "Cocker Spaniel",
    "Cocker Spaniel (American)",
    "Coton de Tulear",
    "Dalmatian",
    "Doberman Pinscher",
    "Dogo Argentino",
    "Dutch Shepherd",
    "English Setter",
    "English Shepherd",
    "English Springer Spaniel",
    "English Toy Spaniel",
    "English Toy Terrier",
    "Eurasier",
    "Field Spaniel",
    "Finnish Lapphund",
    "Finnish Spitz",
    "French Bulldog",
    "German Pinscher",
    "German Shepherd Dog",
    "German Shorthaired Pointer",
    "Giant Schnauzer",
    "Glen of Imaal Terrier",
    "Golden Retriever",
    "Gordon Setter",
    "Great Dane",
    "Great Pyrenees",
    "Greyhound",
    "Griffon Bruxellois",
    "Harrier",
    "Havanese",
    "Irish Setter",
    "Irish Terrier",
    "Irish Wolfhound",
    "Italian Greyhound",
    "Japanese Chin",
    "Japanese Spitz",
    "Keeshond",
    "Komondor",
    "Kooikerhondje",
    "Kuvasz",
    "Labrador Retriever",
    "Lagotto Romagnolo",
    "Lancashire Heeler",
    "Leonberger",
    "Lhasa Apso",
    "Maltese",
    "Miniature American Shepherd",
    "Miniature Pinscher",
    "Miniature Schnauzer",
    "Newfoundland",
    "Norfolk Terrier",
    "Norwich Terrier",
    "Nova Scotia Duck Tolling Retriever",
    "Old English Sheepdog",
    "Olde English Bulldogge",
    "Papillon",
    "Pekingese",
    "Pembroke Welsh Corgi",
    "Perro de Presa Canario",
    "Pharaoh Hound",
    "Plott",
    "Pomeranian",
    "Poodle (Miniature)",
    "Poodle (Toy)",
    "Pug",
    "Puli",
    "Pumi",
    "Rat Terrier",
    "Redbone Coonhound",
    "Rhodesian Ridgeback",
    "Rottweiler",
    "Russian Toy",
    "Saint Bernard",
    "Saluki",
    "Samoyed",
    "Schipperke",
    "Scottish Deerhound",
    "Scottish Terrier",
    "Shetland Sheepdog",
    "Shiba Inu",
    "Shih Tzu",
    "Shiloh Shepherd",
    "Siberian Husky",
    "Silky Terrier",
    "Smooth Fox Terrier",
    "Soft Coated Wheaten Terrier",
    "Spanish Water Dog",
    "Spinone Italiano",
    "Staffordshire Bull Terrier",
    "Standard Schnauzer",
    "Swedish Vallhund",
    "Thai Ridgeback",
    "Tibetan Mastiff",
    "Tibetan Spaniel",
    "Tibetan Terrier",
    "Toy Fox Terrier",
    "Treeing Walker Coonhound",
    "Vizsla",
    "Weimaraner",
    "Welsh Springer Spaniel",
    "West Highland White Terrier",
    "Whippet",
    "White Shepherd",
    "Wire Fox Terrier",
    "Wirehaired Pointing Griffon",
    "Wirehaired Vizsla",
    "Xoloitzcuintli",
    "Yorkshire Terrier"
]



const main = Vue.createApp({
    data() {
        return {
            dogs: dog_array,
            username: '',
            owner_fname: "",
            owner_lname: "",
            owner_gender: "",
            owner_dob: "",
            owner_img: "",
            dog_name: "",
            dog_gender : "",
            dog_dob: "",
            dog_img: "",
            breed: "",
            weight: "",
            personality: [],
            fav_place: "",
            can_edit: false,
            personality_others: ''
        }
    },
    created: function() {
        this.getProfile("owner")
    },
    methods: {
        getProfile(value) {
            let url = ''
            if(value == 'owner') {
                url = "process_owner.php"
                axios.get(url)
                .then(response => {
                    let detail = response.data
                    let fname = detail.fname
                    let lname = detail.lname
                    let owner_gender = detail.gender
                    let owner_dob = detail.birthday
                    let owner_img = detail.image_url
                    let username = response.data.username

                    this.username = username
                    this.owner_fname = fname
                    this.owner_lname = lname
                    this.owner_img = owner_img
                    this.owner_dob = owner_dob
                    this.owner_gender = owner_gender
        
                
        
        
                    
                })
                .catch(error => {
                    console.log(error.message)
                })
            }
        
            else if(value == 'dog') {
                url = "authenticate.php"
        
                axios.get(url)
                .then(response => {
                    let detail = response.data
                    let dog_name = detail.dog_name
                    let dog_img = detail.img_src
                    let dog_gender = detail.gender
                    let dog_dob = detail.birthday
                    let breed = detail.breed
                    let personality = detail.personality
                    let weight = detail.weight
                    let fav_place = detail.fav_place
                    
                    this.dog_name = dog_name
                    this.dog_dob = dog_dob
                    this.dog_gender = dog_gender
                    this.dog_img = dog_img
                    this.fav_place = fav_place
                    this.breed = breed
                    // this.weight = weight
                    
                    if (weight.includes("Less")) {
                        this.weight = 'Less than 15kg'
                    }
                    else if (weight.includes("More")) {
                        this.weight = 'More than 25kg'
                    }
                    else {
                        this.weight = '15kg - 25kg'
                    }
                    
        
                    // personality
                    let personality_split = personality.toLowerCase().split(",")
                    const personality_array = ['energetic', 'friendly','gentle','reserved','sensitive']
                    others_str = ''
        
                    for(description of personality_split) {
                        description = description.trim()
                        if(personality_array.indexOf(description) == -1) {
                            others_str += description.charAt(0).toUpperCase() + description.slice(1) + ", "
                        }
                        else {
                            this.personality.push(description)
                        }
                    }

                    
        
                    others_str = others_str.slice(0,-2)
                    if(others_str.length > 0) {
                        this.personality_others = others_str
                    }
        
                    
                    
                    
        
        
                    
                })
                .catch(error => {
                    console.log(error.message)
                })
            }
            
            
        
        },
        
editProfile() {
    this.can_edit = true


},


saveProfile(value) {
    this.can_edit = false
    if(this.$refs.isChecked.checked == false) {
        this.personality_others = ''
    }

    if(value == 'owner') {
        document.getElementById("owner_form").submit()
    }
    else if(value == 'dog') {
        document.getElementById("dog_form").submit()
    }



    
},

showPreview(value) {
    if(value == 'owner') {
        this.owner_img = URL.createObjectURL(event.target.files[0]);
    
    }
    else if(value == 'dog') {
        this.dog_img = URL.createObjectURL(event.target.files[0]);

    }
}

    }
})



main.mount("#main")


// make alert disappear after 5 seconds

window.setTimeout("closeAlert();", 5000);

function closeAlert(){
    document.getElementById("alert_error").style.display=" none";
}


document.getElementById("sign_out_badge").onclick = function () {
    location.href = "logout.php";
};

