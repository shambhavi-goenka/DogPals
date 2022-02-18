//setting map options

//set with singapores coordinates
var currLatLng = {
    lat: 1.3521,
    lng: 103.8198
}
// Singapores coordinates to be the center of the map
var mapOptions = {
    center: currLatLng,
    zoom: 11.00,
    mapTypeId: google.maps.MapTypeId.ROADMAP
}

//create a map

var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions)

//directions service object to use route and to get a result for our request

var directionService = new google.maps.DirectionsService()

//create DirectionsRenderer object which we wll use to display

var directionsDisplay = new google.maps.DirectionsRenderer();

//bind the directionsRenderer to the map

directionsDisplay.setMap(map)


function calcRoute() {
    //create a request
    var request = {
        origin: document.getElementById("from").value,
        destination: document.getElementById("to").value,
        travelMode: google.maps.TravelMode[document.getElementById("mode").value], //WALKING OR DRIVING
        unitSystem: google.maps.UnitSystem.METRIC
    }

    //Pass request to root method
    directionService.route(request, (result, status)=> {
        const output = document.querySelector("#output")
        if (status == google.maps.DirectionsStatus.OK) {

            // if same location
            if (document.getElementById("from").value == document.getElementById("to").value){
                //delete route from map
                directionsDisplay.setDirections({routes: []})
                //center map
                map.setCenter(currLatLng);
                output.innerHTML = `<div class='alert-danger my-4 rounded mb-4' id='div-output'> <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>  Please select two different locations! </div>`
            }
            else{
                //get distance and time

                //if user selects driving
                if(document.getElementById("mode").value == "DRIVING"){
                    output.innerHTML = "<div style='background: #fcd6a2' id='div-output' class='mt-4'><b> From: </b> "+ document.getElementById("from").value + ".<br><b> To: </b> " + document.getElementById("to").value + "<br><b> Driving Distance <i class='fas fa-road'></i>:</b> " + result.routes[0].legs[0].distance.text + "<br><b> Duration <i class='fas fa-hourglass-start'></i>:</b> " + result.routes[0].legs[0].duration.text  +". </div>"
                    //display route
                    directionsDisplay.setDirections(result);
                }

                // if user selects walking
                else if(document.getElementById("mode").value == "WALKING"){
                    output.innerHTML = "<div style='background: #fcd6a2' id='div-output' class='mt-4'><b> From: </b> "+ document.getElementById("from").value + ".<br><b> To: </b> " + document.getElementById("to").value + "<br><b> Walking Distance <i class='fas fa-walking'></i>:</b> " + result.routes[0].legs[0].distance.text + "<br><b> Duration <i class='fas fa-hourglass-start'></i>:</b> " + result.routes[0].legs[0].duration.text  +". </div>"
                    //display route
                    directionsDisplay.setDirections(result);
                }
            }
        }

        // if location is invalid or blank
        else {
            //delete route from map
            directionsDisplay.setDirections({routes: []})
            //center map
            map.setCenter(currLatLng);
            //show error messsage
            output.innerHTML = `<div class='alert-danger mt-4 rounded mb-4' id='div-output'> <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>Please select a valid location! </div>`
        }
    })
}

//create autocomplete objects for all input

var options = {
    //we expect our user to search for, here would be establishments
    types: ['establishment'],
    //set to only singapore
    componentRestrictions: {"country": ["SG"]},
    // limit api calls
    fields: ['place_id', 'geometry', 'name']
}

// to create autocomplete for where the user is from
var input1 = document.getElementById("from")
var autocomplete1 = new google.maps.places.Autocomplete(input1, options)

// to create autocomplete for destination of user
var input2 = document.getElementById("to")
var autocomplete2 = new google.maps.places.Autocomplete(input2, options)


//axios to pull
axios.get('placesloader.php')
.then(response => {
    let placesArray = response.data
    //process array
    let diffArr = processData(placesArray)

    //only display 3 carsds
    displayThree(diffArr)
    //adding marker
    addMarker(diffArr)
})
.catch(error => {
    console.log(error.message)
})

// define icons
const icons = {
    park: {
        icon: "images/places/icons/svg/tree.png"
    },
    grooming: {
        icon: "images/places/icons/svg/grooming.png"
    },
    dining: {
        icon: "images/places/icons/svg/dining.png"
    },
    others: {
        icon: "images/places/icons/svg/footprint.png"
    },
    petstore: {
        icon: "images/places/icons/svg/petstore.png"
    },
    vet: {
        icon: "images/places/icons/svg/vet.png"
    }
}

//icons
function getIconSrc(placeType){
    let icon = icons.others.icon
    if (placeType == "park"){
        icon = icons.park.icon
    }
    if (placeType == "dining"){
        icon = icons.dining.icon
    }
    if (placeType == "Pet-store"){
        icon = icons.petstore.icon
    }
    if (placeType == "Pet Grooming"){
        icon = icons.grooming.icon
    }
    if (placeType == "Vet Clinics"){
        icon = icons.vet.icon
    }
    return icon
}

// processing array
function processData(array){
    diningArr = []
    parkArr = []
    storeArr = []
    groomingArr = []
    vetArr = []
    otherArr = []
    for(obj of array){
        //check for type of places
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
    return [diningArr,parkArr,storeArr,groomingArr,vetArr,otherArr]
}

// to display only 3 cards for each place
function displayThree(diffArrs){
    for(arr of diffArrs) {
        let placeType = arr[0].placeType
        let displayPlace = placeType.charAt(0).toUpperCase()+placeType.slice(1)
        let str = `
                <div class="container mt-5 ${placeType}">
                    <div class="row">
                        <div class="col">
                            <h3 class = 'place_cat' >${displayPlace}</h3>
                            <br>
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <h5 class="text-end" >
                                <a href="find_a_place_seemore.html" style="text-decoration: none; color:black;" id = 'see_more'>
                                    See more&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-right"></i>
                                </a>
                            </h5>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-3 g-4 align-center">
        `
        let length = 3
        // will only show 3 cards for each place
        for (i=0; i<length; i++){
            let accessedObj = arr[i]
            let place = accessedObj.place
            let ID = accessedObj.placeID
            let imageSrc = "images/places/" + String(ID) + ".jpg"
            let placeLoc = accessedObj.placeLoc
            let placeDesc = accessedObj.placeDesc
            let placeLink = accessedObj.placeLink
            let icon = getIconSrc(placeType)
            str += `
            <div class="col">
                <div class="card mx-auto justify-content-center cards h-100 border-0" style="width: 18rem; border: 1px solid black; border-radius: 15px;">
                    <img src="${imageSrc}" alt="..." style="
                    height: auto;
                    border-radius: 15px 15px 0 0;
                    position: relative;" class="img-fluid">
                    <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-center">${place}<br>
                    <div style="color: black; font-weight=200; font-size: 17px;"><img src="${icon}" style="width:20px">&nbsp;${placeType.charAt(0).toUpperCase()+placeType.slice(1)}</div></h5>
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
        str += `</div></div>`
        document.getElementById(placeType).innerHTML = str
    }
}

//globally define infowindow
var infowindow = new google.maps.InfoWindow();

//adding all markers
function addMarker(diffArrs){
    for(arr of diffArrs) {
        let placeType = arr[0].placeType
        let length = arr.length
        for (i=0; i<length; i++){
            let accessedObj = arr[i]
            let place = accessedObj.place
            let placeLoc = accessedObj.placeLoc
            let ID = accessedObj.placeID
            let imageSrc = "images/places/" + String(ID) + ".jpg"
            let lat = accessedObj.lat
            let lon = accessedObj.lon
            
            let icon = getIconSrc(placeType)
            var pos = new google.maps.LatLng(lat, lon);
            var title = place
            var iwContent = `<h5><IMG BORDER="0" ALIGN="Left" SRC="${icon}" WIDTH="20">${placeType.charAt(0).toUpperCase()+placeType.slice(1)}: ${place}</h5>
                            <IMG BORDER="0" ALIGN="Left" SRC="${imageSrc}" WIDTH="200"><br>
                            <strong>Location: ${placeLoc}</strong>
                            `
            //to create markers for all locations
            createMarker(pos, title, iwContent, icon)
        }
    }
}

// individually creating all markers
function createMarker(latlon,title,iwContent, icon) {
    var marker = new google.maps.Marker({
        position: latlon,
        title: title,
        map: map,
        icon: {
            url: icon,
            scaledSize: new google.maps.Size(20,20)
        },
        animation: google.maps.Animation.DROP
    })
    google.maps.event.addListener(marker, 'click', function () {
        infowindow.setContent(iwContent);
        infowindow.open(map, marker);
    })
}

