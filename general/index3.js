function showDescription(button) {
    const row1 = button.nextElementSibling;
    const row2 = button.nextElementSibling.nextElementSibling;
    
    const description1 = row1.textContent;
    const description2 = row2.textContent;
    document.getElementById('popup-description').textContent = description1;
    document.getElementById('section-applicable').textContent = description2;
    document.getElementById('description-popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('description-popup').style.display = 'none';
}

function showDescription1(button) {
    const row1 = button.nextElementSibling;              
    const description1 = row1.textContent;        
    document.getElementById('popup-description1').textContent = description1;        
    document.getElementById('description-popup1').style.display = 'block';
}

function closePopup1() {
    document.getElementById('description-popup1').style.display = 'none';
}
function showDescription2(button) {
    const row1 = button.nextElementSibling;
    const row2 = button.nextElementSibling.nextElementSibling;
    
    const description1 = row1.textContent;
    const description2 = row2.textContent;
    document.getElementById('popup-description2').textContent = description1;
    document.getElementById('section-applicable2').textContent = description2;
    document.getElementById('description-popup2').style.display = 'block';
}

function closePopup2() {
    document.getElementById('description-popup2').style.display = 'none';
}


// async function generateData(button){
//     const row1 = button.nextElementSibling;              
//     const description = row1.textContent;
//     button.innerText="Generating..";
//     const firdata= await generateFIR(description);
//     const ipcsec= await generateIPC(firdata);
//     document.getElementById('fir_data').value=firdata;
//     document.getElementById('ipc_sec').value=ipcsec;
//     button.innerText="Generate FIR & IPC Sections";
//     alert("Success!");
//     document.getElementById('updtdb').style.display="block";
    
// }
// function generateFIR(description){
//     setTimeout(()=>{        
//         return description;
//         },12000)
       
    
// }

// function generateIPC(firdata){
//     setTimeout(()=>{
//         return firdata;
    
//     },12000)
       
// }

async function generateData(button) {
    const row1 = button.nextElementSibling;
    const description = row1.textContent;
    
    button.innerText = "Generating..";

    try {


        fetch('http://localhost:5000/predict_section_and_punishment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ userInput: description }),
            })
            .then(response => response.json())
            .then(data => {
                // displayResults(userInput, data.result1, data.result2);
                let ipcsec=data.result1;
                let ipcsec2 =data.result2;
                let firdata=description;

                console.log(ipcsec,"=====",data.result2);
                
                document.getElementById('fir_data').value = firdata;
                document.getElementById('ipc_sec').value = ipcsec;

                button.innerText = "Generate FIR & IPC Sections";
                alert("Success!");
                document.getElementById('updtdb').style.display = "block";
            })
            .catch(error => {
                console.error('Error:', error);
            });
            // console.log(ipcsec,"=====",ipcsec2);



        // const firdata = await generateFIR(description);
        // const ipcsec = await generateIPC(firdata);

        
    } catch (error) {
        console.error("Error:", error);
        button.innerText = "Generate FIR & IPC Sections";
        alert("Error occurred!");
    }
}

function generateFIR(description) {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve(description);
        }, 12000);
    });
}

function generateIPC(firdata) {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve(firdata);
        }, 12000);
    });
}
