const filter = Vue.createApp({

    data() {
        return {
            num_of_dogs: 0, 
            display_first_three: "",
            display_all: "",
            search_dogs: "", 
            selected_age: [],
            selected_breed: [],
            selected_gender: [],
            selected_personality: [],
            selected_size: [],
        }
    }, 

    created: function() {
        // console.log("=== created ===")

        this.retrieveDogs()
    }, 

    methods: {

        // retrieving all dogs
        retrieveDogs() {

            axios.get('server.php')
            .then(response => {
                // Array of objects
                // console.log(response.data)
                var dogs = response.data

                this.displayDogs(dogs)

            })
            .catch(error => {
                console.log(error.message)
            })
        }, 

        // searching / filtering dogs
        searchFilterDogs() {
            // console.log("=== processing searchFilterDogs() === ")
            if (this.search_dogs == "" && this.selected_age.length == 0 && this.selected_breed.length == 0 && this.selected_gender.length == 0 && this.selected_personality.length == 0 && this.selected_size.length == 0) {

                // console.log(this.search_dogs)
                // console.log(this.selected_age)
                // console.log(this.selected_breed)
                // console.log(this.selected_gender)
                // console.log(this.selected_personality)
                // console.log(this.selected_size)

                this.retrieveDogs()

                return false
            
            } else {

                axios.get('server.php')
                .then(response => {
    
                    // Array of objects
                    // console.log(response.data)

                    var dogs = {}

                    // displaying based on search input
                    if (this.search_dogs != "") {
                        var target_dog = this.search_dogs.toLowerCase().trim()
                        // console.log(target_dog)

                        for (dog of response.data) {
                            current_dog_name = dog.name.toLowerCase().trim()
                            current_dog_breed = dog.breed.toLowerCase().trim()
                            // console.log(current_dog)
                            // console.log(current_dog_breed)

                            if (current_dog_name.includes(target_dog) || (current_dog_breed.includes(target_dog))) {
                                let dogs_in_nested_arr = Object.values(dogs) 
                                let dogs_in_arr = []
                                for (dog_in_nested_arr of dogs_in_nested_arr) {
                                    dogs_in_arr.push(dog_in_nested_arr[0])
                                }
                                if (!dogs_in_arr.includes(dog)) {
                                    let len = Object.keys(dogs).length
                                    dogs[Number(len) + 1] = [dog, 'YES']
                                }
                            }
        
                        }

                        let new_dogs_array = []
                        for ([key, value] of Object.entries(dogs)) {
                            if (value[1] == "YES") {
                                new_dogs_array.push(value[0])
                            }
                        }
    
                        // console.log(new_dogs_array)
    
                        this.displayDogs(new_dogs_array)
                    }

                    // displaying based on age
                    if (this.selected_age.length >= 1) {
                        var selected_dog_age = JSON.parse(JSON.stringify(this.selected_age))
                        // console.log(selected_dog_age)

                        var age_range_arr = []
    
                        for (age of selected_dog_age) {
                            var split_age = age.split("-")
                            // console.log(split_age)
                            age_range_arr.push(split_age[0])
                            age_range_arr.push(split_age[1])
    
                        }
    
                        var max_age = Math.max.apply(null, age_range_arr)
                        // console.log(max_age)
                        var min_age = Math.min.apply(null, age_range_arr)
                        // console.log(min_age)

                        if (Object.keys(dogs).length == 0) { // no dogs in array yet
                            for (dog of response.data) {
                                var current_dog_age = dog.age
                                // console.log(current_dog_age)
        
                                if (current_dog_age >= min_age && current_dog_age <= max_age) {
                                    let dogs_in_nested_arr = Object.values(dogs) 
                                    let dogs_in_arr = []
                                    for (dog_in_nested_arr of dogs_in_nested_arr) {
                                        dogs_in_arr.push(dog_in_nested_arr[0])
                                    }
                                    if (!dogs_in_arr.includes(dog)) {
                                        let len = Object.keys(dogs).length
                                        dogs[Number(len) + 1] = [dog, 'YES-A ']
                                    }
                                }
                            }
    
                        } else {

                            for ([key, value] of Object.entries(dogs)) { // there are alr dogs inside the dogs array

                                var current_dog_age = value[0].age
                                // console.log(current_dog_age)
        
                                if ((current_dog_age >= min_age && current_dog_age <= max_age) && (!value[1].includes("YES-A"))) {
                                    value[1] += 'YES-A '
                                } else if ((current_dog_age < min_age && current_dog_age > max_age) && (!value[1].includes("YES-A"))) {
                                    value[1] += 'NO-A '
                                } 
                                
                            }
                        } 
                    }

                    // displaying based on breed
                    if (this.selected_breed.length >= 1) {
                        var selected_dog_breed = JSON.parse(JSON.stringify(this.selected_breed))
                        // console.log(selected_dog_breed)

                        if (Object.keys(dogs).length == 0) { // no dogs in array yet

                            for (dog of response.data) {
                                var current_dog_breed = dog.breed
                                // console.log(current_dog_breed)

                                for (breed of selected_dog_breed) {
                                    if (current_dog_breed.includes(breed.charAt(0).toUpperCase() + breed.slice(1))) {
                                        let dogs_in_nested_arr = Object.values(dogs) 
                                        
                                        let dogs_in_arr = []
                                        for (dog_in_nested_arr of dogs_in_nested_arr) {
                                            dogs_in_arr.push(dog_in_nested_arr[0])
                                        } 

                                        if (!dogs_in_arr.includes(dog)) {
                                        
                                            let len = Object.keys(dogs).length
                                            dogs[Number(len) + 1] = [dog, 'YES-B ']
                                        }
                                    }
                                }
                            }

                        } else {

                            for ([key, value] of Object.entries(dogs)) { // there are alr dogs inside the dogs array
                                
                                var current_dog_breed = value[0].breed
                                // console.log(current_dog_breed)

                                for (breed of selected_dog_breed) {
                                    if (current_dog_breed.includes(breed.charAt(0).toUpperCase() + breed.slice(1)) && (!value[1].includes("YES-B"))) {
                                        value[1] += 'YES-B '
                                    } else if (current_dog_breed.includes(breed.charAt(0).toUpperCase() + breed.slice(1)) == false && (!value[1].includes("YES-B"))) {
                                        value[1] += 'NO-B ' 
                                    } 

                                }   
                            }
                        }
                    }

                    // displaying based on gender
                    if (this.selected_gender.length >= 1) {
                        var selected_dog_gender = JSON.parse(JSON.stringify(this.selected_gender))
                        // console.log(selected_dog_gender)

                        if (Object.keys(dogs).length == 0) { // no dogs in array yet

                            for (dog of response.data) {
                                var current_dog_gender = dog.gender
                                // console.log(current_dog_gender)
        
                                if (selected_dog_gender.includes(current_dog_gender.toLowerCase())) {
                                    let dogs_in_nested_arr = Object.values(dogs) 
                                       
                                    let dogs_in_arr = []
                                    for (dog_in_nested_arr of dogs_in_nested_arr) {
                                        dogs_in_arr.push(dog_in_nested_arr[0])
                                    }
                                    if (!dogs_in_arr.includes(dog)) {
                                        let len = Object.keys(dogs).length
                                        dogs[Number(len) + 1] = [dog, 'YES-G ']
                                    }
                                }
        
                            }
                        } else {

                            for ([key, value] of Object.entries(dogs)) { // there are alr dogs inside the dogs array
                                var current_dog_gender = value[0].gender
                                // console.log(current_dog_gender)

                                if (selected_dog_gender.includes(current_dog_gender.toLowerCase()) && (!value[1].includes("YES-G"))) {
                                    value[1] += 'YES-G '
                                } else if (selected_dog_gender.includes(current_dog_gender.toLowerCase()) == false && (!value[1].includes("YES-G"))) {
                                    value[1] += 'NO-G '
                                }
                                
                                
                            }
                        }
                    }

                    // displaying based on personality
                    if (this.selected_personality.length >= 1) {
                        var selected_dog_personality = JSON.parse(JSON.stringify(this.selected_personality))
                        // console.log(selected_dog_personality)

                        if (Object.keys(dogs).length == 0) { // no dogs in array yet

                            for (dog of response.data) {
                                var current_dog_personality_str = dog.personality
                                // console.log(current_dog_personality_str)

                                var current_dog_personality_arr = current_dog_personality_str.split(", ")
                                // console.log(current_dog_personality_arr)

                                for (personality of selected_dog_personality) {
                                    if (current_dog_personality_arr.includes(personality.charAt(0).toUpperCase() + personality.slice(1))) {

                                        let dogs_in_nested_arr = Object.values(dogs) 
                                       
                                        let dogs_in_arr = []
                                        for (dog_in_nested_arr of dogs_in_nested_arr) {
                                            dogs_in_arr.push(dog_in_nested_arr[0])
                                        }

                                        if (!dogs_in_arr.includes(dog)) {
                                            let len = Object.keys(dogs).length
                                            dogs[Number(len) + 1] = [dog, 'YES-P ']
                                        }
                                    }
                                }
        
                            }

                        } else {

                            for ([key, value] of Object.entries(dogs)) { // there are alr dogs inside the dogs array

                                var current_dog_personality_str = value[0].personality
                                // console.log(current_dog_personality_str)
                                var current_dog_personality_arr = current_dog_personality_str.split(", ")
                                // console.log(current_dog_personality_arr)

                                for (personality of selected_dog_personality) {
                                    if (current_dog_personality_arr.includes(personality.charAt(0).toUpperCase() + personality.slice(1)) && (!value[1].includes("YES-P"))) {
                                        value[1] += 'YES-P '
                                    } else if (current_dog_personality_arr.includes(personality.charAt(0).toUpperCase() + personality.slice(1)) == false && (!value[1].includes("YES-P"))) {
                                        value[1] += 'NO-P '
                                    }
                                }
                                
                            }
                        }
                    }

                    // displaying based on size
                    if (this.selected_size.length >= 1) {
                        var selected_dog_size = JSON.parse(JSON.stringify(this.selected_size))
                        // console.log(selected_dog_size)

                        if (Object.keys(dogs).length == 0) { // no dogs in array yet
                            for (dog of response.data) {
                                var current_dog_size = dog.size
                                // console.log(current_dog_size)
        
                                if (selected_dog_size.includes(current_dog_size)) {
                                    let dogs_in_nested_arr = Object.values(dogs) 
                                       
                                    let dogs_in_arr = []
                                    for (dog_in_nested_arr of dogs_in_nested_arr) {
                                        dogs_in_arr.push(dog_in_nested_arr[0])
                                    }

                                    if (!dogs_in_arr.includes(dog)) {
                                        let len = Object.keys(dogs).length
                                        dogs[Number(len) + 1] = [dog, 'YES-S ']
                                    }
                                }
        
                            }
                        } else {
                            
                            for ([key, value] of Object.entries(dogs)) {

                                var current_dog_size = value[0].size
                                // console.log(current_dog_size)
        
                                if (selected_dog_size.includes(current_dog_size) && (!value[1].includes("YES-S"))) {
                                    value[1] += 'YES-S '
                                } else if (selected_dog_size.includes(current_dog_size) == false && (!value[1].includes("YES-S"))) {
                                    value[1] += 'NO-S '
                                }
                                
                                
                            }
                        }
                    }


                    // console.log(this.selected_age)
                    // console.log(this.selected_breed)
                    // console.log(this.selected_gender)
                    // console.log(this.selected_personality)
                    // console.log(this.selected_size)

                    // console.log(dogs)

                    var check_values = []
                    if (this.selected_age.length >= 1) {
                        check_values.push("A")
                    }
                    if (this.selected_breed.length >= 1) {
                        check_values.push("B")
                    }
                    if (this.selected_gender.length >= 1) {
                        check_values.push("G")
                    }
                    if (this.selected_personality.length >= 1) {
                        check_values.push("P")
                    }
                    if (this.selected_size.length >= 1) {
                        check_values.push("S")
                    }

                    // console.log(check_values)

                    var new_dogs_array = []

                    for ([key, value] of Object.entries(dogs)) {
                    
                        var check = value[1]
                        var check_arr = check.split(" ")
                        // console.log(check_arr)

                        var status = 0
                        for (val of check_values) {
                            for (element of check_arr) {
                                if (element.slice(-1).includes(val) && element.includes("YES")) {
                                    status += 1
                                }
                            }
                        }

                        // console.log(status)
                        if (status == check_values.length) {
                            new_dogs_array.push(value[0])
                        }
                    }

                    // console.log(new_dogs_array)
                    this.displayDogs(new_dogs_array)


                   
                })
                .catch(error => {
                    console.log(error.message)
                })
            }
        }, 

        // clearing selected options in filter bar 
        clearSelectedOptions() {

            this.selected_age = []
            this.selected_breed = []
            this.selected_gender = []
            this.selected_personality = []
            this.selected_size = []

        }, 

        // displaying dogs
        displayDogs(dogs) {

            this.num_of_dogs = dogs.length
            
            var count_row = 1
        
            var first_three_str = `<div id="row-${count_row}" class="row mt-2">` 
        
        
            for (dog of dogs.slice(0, 3)) {

                first_three_str += `<div class="col-lg-4 col-xs-12 mb-4">
                                        <div class="card h-100 border-0 rounded-3">
                                            <img src="${dog.image_url}" class="card-img-top" alt="${dog.name}">
                                            <div class="card-body">
                                                <h5 class="card-title text-center">${dog.name}</h5>
                                                <br>
                                                <p class="card-text">Breed: ${dog.breed}</p>
                                                <p class="card-text">Gender: ${dog.gender}</p>
                                                <p class="card-text">Age: ${dog.age}</p>
                                                <div class="text-center">
                                                    <a href="individual_dog.php?id=${dog.dogid}" class="btn btn-warning rounded-pill mt-auto">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
            }

            first_three_str += `</div>`

            this.display_first_three = first_three_str

            count_row++
        
            var display_all_str = `<div class="row">
                                        <div class="col-lg-3">
                                
                                        </div>
                                        <div class="col-lg-9 col-xs-10">
                                            <div id="row-${count_row}" class="row mt-2">` 
        
            var dog_count_per_row = 1

            for (dog of dogs.slice(3)) {

                if (dog_count_per_row <= 3) {
                    
                    display_all_str += `<div class="col-lg-4 col-xs-12 mb-4">
                                            <div class="card h-100 border-0 rounded-3">
                                                <img src="${dog.image_url}" class="card-img-top" alt="${dog.name}">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">${dog.name}</h5>
                                                    <br>
                                                    <p class="card-text">Breed: ${dog.breed}</p>
                                                    <p class="card-text">Gender: ${dog.gender}</p>
                                                    <p class="card-text">Age: ${dog.age}</p>
                                                    <div class="text-center">
                                                        <a href="individual_dog.php?id=${dog.dogid}" class="btn btn-warning rounded-pill mt-auto">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`
        
                    dog_count_per_row++
        
        
                } else {
        
                    display_all_str += `    </div>
                                        </div>
                                    </div>`
                    
                    count_row++
                    var dog_count_per_row = 1
        
                    display_all_str += `<div class="row"> 
                                            <div class="col-lg-3">
                    
                                            </div>
                                            <div class="col-lg-9 col-xs-10">
                                                <div id="row-${count_row}" class="row mt-2">
                                                    <div class="col-lg-4 col-xs-12 mb-4">
                                                        <div class="card h-100 border-0 rounded-3">
                                                            <img src="${dog.image_url}" class="card-img-top" alt="${dog.name}">
                                                            <div class="card-body">
                                                                <h5 class="card-title text-center">${dog.name}</h5>
                                                                <br>
                                                                <p class="card-text">Breed: ${dog.breed}</p>
                                                                <p class="card-text">Gender: ${dog.gender}</p>
                                                                <p class="card-text">Age: ${dog.age}</p>
                                                                <div class="text-center">
                                                                    <a href="individual_dog.php?id=${dog.dogid}" class="btn btn-warning rounded-pill mt-auto">Read More</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>`
                    
                    dog_count_per_row++
        
                }
        
            
            }

            this.display_all = display_all_str

        }

    }, 


})

filter.mount("#filter")