const app1 = Vue.createApp({
    data() {
        return{
            //initialising icons
            icons: {
                park: {
                    icon: "images/places/icons/svg/tree.png"
                },
                grooming: {
                    icon: "images/places/icons/svg/grooming.png"
                },
                dining: {
                    icon: "images/places/icons/svg/dining.png"
                },
                petstore: {
                    icon: "images/places/icons/svg/petstore.png"
                },
                vet: {
                    icon: "images/places/icons/svg/vet.png"
                },
                others: {
                    icon: "images/places/icons/svg/footprint.png"
                },
            },
            // Array to store places after called by API
            displayArr: [],
            // To store the number of places
            num_of_places: 0,
            //
            search_places: "",
            //filtered places in html code
            displayText: "",
            // To store which checkboxes are checked
            park: {
                checked: false,
            },
            grooming: {
                checked: false,
            },
            dining: {
                checked: false,
            },
            petstore:{
                checked: false,
            },
            vet: {
                checked: false,
            },
            other: {
                checked: false,
            },
        }
    },
    methods: {
        // this is to get the response from placesloader
        getAPI(){
            axios.get('placesloader.php')
            .then(response => {
                let placesArray = response.data
                this.processData(placesArray)
            })
            .catch(error => {
                console.log(error.message)
            })
        },
        //getting icons based on wat type of location it is (park, dining, etc)
        getIconSrc(placeType){
            let icon = this.icons.others.icon
            if (placeType == "park"){
                icon = this.icons.park.icon
            }
            if (placeType == "dining"){
                icon = this.icons.dining.icon
            }
            if (placeType == "Pet-store"){
                icon = this.icons.petstore.icon
            }
            if (placeType == "Pet Grooming"){
                icon = this.icons.grooming.icon
            }
            if (placeType == "Vet Clinics"){
                icon = this.icons.vet.icon
            }
            return icon
        },
        // storing the array in data properties and returning it to the called function
        processData(array){
            diningArr = []
            parkArr = []
            storeArr = []
            groomingArr = []
            vetArr = []
            otherArr = []
            for(obj of array){
                // console.log(obj.placeType)
                if(obj.placeType == "dining"){
                    diningArr.push(obj)
                }
                else if(obj.placeType == "park"){
                    parkArr.push(obj)
                }
                else if(obj.placeType == "pet-store"){
                    storeArr.push(obj)
                }
                else if(obj.placeType == "Pet Grooming"){
                    groomingArr.push(obj)
                }
                else if(obj.placeType == "Vet Clinics"){
                    vetArr.push(obj)
                }
                else if(obj.placeType == "other"){
                    otherArr.push(obj)
                }
            }

            //storing the array in data property displayArr
            this.displayArr = [diningArr,parkArr,storeArr,groomingArr,vetArr,otherArr]
        },
        clearSelectedOptions(){
            this.park.checked = false
            this.dining.checked = false
            this.grooming.checked = false
            this.petstore.checked = false
            this.vet.checked = false
            this.other.checked = false
        }

    },
    created: function() {
        // once page is loaded, getAPI() function is called
        this.getAPI()
    },
    computed: {
        // 
        processCheck(){
            //initialise initial number of places
            let num_of_places = 0;

            let parkChecked = this.park.checked
            let diningChecked = this.dining.checked
            let groomingChecked = this.grooming.checked
            let petstoreChecked = this.petstore.checked
            let vetChecked = this.vet.checked
            let otherChecked = this.other.checked

            //getting all arrays, previously stored from API
            let arrNow = this.displayArr

            let str = `<div class="row row-cols-1 row-cols-md-3 g-4 align-center">`
            // iterating through all arrays
            for(arr of arrNow) {
                let placeType = arr[0].placeType
                let icon = this.getIconSrc(placeType)
                placeType = placeType.charAt(0).toUpperCase()+placeType.slice(1)
                let length = arr.length
                let check = false

                //check if places checkbox are checked
                if(placeType == "Dining" && diningChecked){
                    check = true
                }
                else if(placeType == "Park" && parkChecked){
                    check = true
                }
                else if(placeType == "Pet-store" && petstoreChecked){
                    check = true
                }
                else if(placeType == "Pet Grooming" && groomingChecked){
                    check = true
                }
                else if(placeType == "Vet Clinics" && vetChecked){
                    check = true
                }
                else if(placeType == "Other" && otherChecked){
                    check = true
                }
                // in the event none of the places are checked. still allow all types to be displayed
                else if (diningChecked == false  && !parkChecked &&  !petstoreChecked && !groomingChecked && !vetChecked && !otherChecked){
                    check = true
                }
                // to process arrays according to filter and search bar
                for (i=0; i<length; i++){
                    let accessedObj = arr[i]
                    let place = accessedObj.place
                    let ID = accessedObj.placeID
                    let imageSrc = "images/places/" + String(ID) + ".jpg"
                    let placeLoc = accessedObj.placeLoc
                    let placeDesc = accessedObj.placeDesc
                    let placeLink = accessedObj.placeLink
                    searchCheck = false
                    if (this.search_places == "" || place.toLowerCase().includes(this.search_places.toLowerCase())) {
                        searchCheck = true
                    }
                    if (check && searchCheck) {
                        num_of_places++
                        // console.log(placeType)
                        str += `
                        <div class="col">
                            <div class="card mx-auto justify-content-center cards h-100 border-0" style="width: 16rem; border: 1px solid black; border-radius: 15px;">
                                <img src="${imageSrc}" alt="..." style="
                                height: auto;
                                border-radius: 15px 15px 0 0;
                                position: relative;" class="img-fluid">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-center">${place}<br>
                                    <div style="color: black; font-weight=200; font-size: 17px;"><img src="${icon}" style="width:20px">&nbsp;${placeType}</div></h5>
                                    <p class="card-text"><strong>Place<i class="fas fa-map-marker-alt icon" aria-hidden="true" style:"font-size: 10px; "></i>:</strong>&nbsp;${placeLoc}<br><br>
                                    <strong>Description:&nbsp;</strong>
                                    ${placeDesc}</p>
                                    <div class= "mt-auto">
                                        <hr>
                                        <div class = 'text-center'>
                                            <a href="${placeLink}" target='_blank' class="btn btn-warning px-4 py-2 rounded-pill text-uppercase mt-auto">Visit Website</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `
                    }
                }
            }
            str += "</div>"
            this.displayText = str
            this.num_of_places = num_of_places
        }
    }
})

app1.mount("#place_see_more")
