// document.querySelector("button").addEventListener("click", (a) => {
//     a.preventDefault();
// });
document.getElementById("ocrButton").addEventListener("click", (a) => {
    a.preventDefault();
});
// document.getElementById("cancel").addEventListener("click", (a) => {
//     a.preventDefault();
// });

  
  let c = "https://script.google.com/macros/s/AKfycbw2J64mNPoiCuz4F2YtBPhDa-t0PZ2G9ONMBH0sVPIE0p2uGwzil9EXSCJv9Q9axgVY/exec";
  let i = document.getElementById("inputFile");
  let p = document.getElementById("ocrButton");
  let l = document.getElementById("description");

  

  function inputValid(){
    if(i.files.length>0){
      i.classList.add("selected");
     
    }
    else{
      i.classList.remove("selected");
     
    }
  }
  p.addEventListener("click", () => {
    p.innerHTML = "Loading ..";
    let a = new FileReader();
    a.readAsDataURL(i.files[0]);
    a.onload = () => {
      let h = a.result.split("base64,")[1];
      fetch(c, {
        method: "POST",
        body: JSON.stringify({
          file: h,
          type: i.files[0].type,
          name: i.files[0].name,
        }),
      })
        .then((n) => n.text()).catch(err=>{console.log("Error From server",err); p.innerHTML = "Perform OCR";})
        .then((n) => {
          l.value += `\n${n}`;
          // console.log("Sucessfully appended data in desc boxs");
          // console.log("Data is: ",n);
          // console.log("Updated Data is: ",l.value);
          p.innerHTML = "Perform OCR";
        }).catch( err =>{ console.log("There is Error",err); p.innerHTML = "Perform OCR";
      });
    };
  });
  
  let g = document.getElementById("voice");
  const r = new (window.webkitSpeechRecognition || window.SpeechRecognition)();
  r.lang = "en-US";
  g.addEventListener("click", (a) => {
    a.preventDefault();
    r.start();
  });
  r.onresult = (a) => {
    const e = a.results[0][0].transcript;
    l.value += `\n${e}`;
  };
  r.onerror = (a) => {
    console.error("Speech recognition error", a.error);
  };
  
  document.getElementById("datePicker").valueAsDate = new Date();
  document.querySelectorAll("option").forEach((a) => {
    a.setAttribute("class", "text-lg bg-slate-800");
  });
  
  let u = {
    amritsar: "Amritsar",
    barnala: "Barnala",
    bathinda: "Bathinda", 
    faridkot: "Faridkot", 
    fatehgarhSahib: "Fatehgarh Sahib",
    fazilka: "Fazilka",
    ferozepur: "Ferozepur",
    gurdaspur: "Gurdaspur",
    hoshiarpur: "Hoshiarpur",
    jalandhar: "Jalandhar",
    kapurthala: "Kapurthala",
    ludhiana: "Ludhiana",
    mansa: "Mansa",
    moga: "Moga",
    muktsar: "Muktsar",
    pathankot: "Pathankot",
    patiala: "Patiala",
    rupnagar: "Rupnagar (Ropar)",
    sahibzadaAjitSinghNagar: "Sahibzada Ajit Singh Nagar (Mohali)",
    sangrur: "Sangrur",
    tarnTaran: "Tarn Taran"

  };
  let s = {
    ajmer: "Ajmer",
    alwar: "Alwar",
    banswara: "Banswara",
    baran: "Baran",
    barmer: "Barmer",
    bharatpur: "Bharatpur",
    bhilwara: "Bhilwara",
    bikaner: "Bikaner",
    bundi: "Bundi",
    chittorgarh: "Chittorgarh",
    churu: "Churu",
    dausa: "Dausa", 
    dholpur: "Dholpur", 
    dungarpur: "Dungarpur", 
    hanumangarh: "Hanumangarh", 
    jaipur: "Jaipur", 
    jaisalmer: "Jaisalmer", 
    jalore: "Jalore", 
    jhalawar: "Jhalawar", 
    jhunjhunu: "Jhunjhunu", 
    jodhpur: "Jodhpur", 
    karauli: "Karauli", 
    kota: "Kota", 
    nagaur: "Nagaur", 
    pali: "Pali", 
    pratapgarh: "Pratapgarh", 
    rajsamand: "Rajsamand", 
    sawaiMadhopur: "Sawai Madhopur", 
    sikar: "Sikar", 
    sirohi: "Sirohi", 
    sriGanganagar: "Sri Ganganagar", 
    tonk: "Tonk", 
    udaipur: "Udaipur"
  };
  let tycr = {
    murder: "Murder",
    theft: "Theft",
    pickPocket: "Pick-Pocket",
    rape: "Rape",
    kidnapping: "Kidnapping",
    missingPerson: "Missing-Person"
  };
  let o = document.getElementById("location_state");
  let t = document.getElementById("location_dist");
  let d = document.getElementById("type_crime");
  
  o.addEventListener("change", () => {
    if (o.value == "Punjab") {
      t.innerHTML = "";
      for (const a in u) {
        let e = document.createElement("option");
        e.innerText = u[a];
        e.value = u[a];
        t.append(e);
      }
    } else if (o.value == "Rajasthan") {
      t.innerHTML = "";
      for (const a in s) {
        let e = document.createElement("option");
        e.innerText = s[a];
        e.value = s[a];
        t.append(e);
      }
    } else {
      t.innerHTML = '<option value="">District</option>';
    }
    document.querySelectorAll("option").forEach((a) => {
      a.setAttribute("class", "text-lg bg-slate-800");
    });
  });

  for (const a in tycr) {
    let e = document.createElement("option");
    e.innerText = tycr[a];
    e.value = tycr[a];
    d.append(e);
  }
  
  d.addEventListener("change", () => {
    d.value == "other"
      ? document.getElementById("otherCrime").classList.remove("hidden")
      : document.getElementById("otherCrime").classList.add("hidden");
  });


  // Function to change keyboard language based on the selected value
  
  document.getElementById('translateButton').addEventListener('click',async (e)=>{
          
          e.preventDefault();
            try {
              const initialData=document.getElementById('description').value;
              document.getElementById('translateButton').innerText="Translating...";
              const translatedData = await cpltranslator(initialData);              
              alert("Success!");
              document.getElementById('translateButton').innerText="Translate";
              document.getElementById('description').value= translatedData;
              isPressed=true;
              document.getElementById('submitbtn').removeAttribute('disabled');                     

            } catch (error) {
                console.error("Error:", error);
                this.innerText = "Translate";
                alert("Error occurred!");
            }

  })



async function cpltranslator(text){
    const url = 'https://google-translate113.p.rapidapi.com/api/v1/translator/text';
    const options = {
    method: 'POST',
    headers: {
    'content-type': 'application/x-www-form-urlencoded',
    'X-RapidAPI-Key': 'e08794af1fmshea6759184714a85p1cdb94jsn04b3fe8e4da1',
    'X-RapidAPI-Host': 'google-translate113.p.rapidapi.com'
    },
    body: new URLSearchParams({
    from: 'auto',
    to: 'en',
    text
    })
    };

    try {
    const response = await fetch(url, options);
    const result = await response.json();
    return result.trans;
    } catch (error) {
    return error;
    }
  
}
  
