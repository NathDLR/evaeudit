window.onload = function(){

    let theTr = document.getElementsByClassName('trBody');
    for (let i = 0; i < theTr.length; i++) {
        let valuOfOnchaneSelect = document.getElementsByClassName('selectResult')[i].getAttribute('onchange');
        let notes = valuOfOnchaneSelect.substr(11, (valuOfOnchaneSelect.length-12)).split(',');
        
        selectNote(notes[0], i+1);
    }

}

function selectNote(value, idRisk) {
    let theNote = document.getElementById('note_'+ idRisk);
    let selectResult = document.getElementById('select_'+ idRisk);
    let contamination = document.getElementsByClassName('area_'+ idRisk)

    if (selectResult.value ==  "Yes"){
        theNote.innerHTML = value;
        for (const contaminationElement of contamination) {
            contaminationElement.disabled = false;
        }
    }else if(selectResult.value ==  "No"){
        theNote.innerHTML = 0;
        for (const contaminationElement of contamination) {
            contaminationElement.disabled = false;
        }
    }else{
        theNote.innerHTML = 0;
        for (const contaminationElement of contamination) {
            contaminationElement.disabled = true;
        }
    }
    refreshNote();
}

function refreshNote() {
    let allNotes = document.getElementsByClassName('note');
    let result = document.getElementsByName('result');
    let theRisk = document.getElementById('risk');

    let calcul = 0;

    for (const allNotesElement of allNotes) {
        calcul += parseInt(allNotesElement.innerHTML);
    }
    result[0].innerHTML = calcul;
    result[1].value = calcul;

    switch (true) {
        case (calcul>riskNotation[0]['valueStart'] && calcul<riskNotation[0]['valueEnd']):
            theRisk.innerHTML = riskNotation[0]['Name']
            break;
        case (calcul>riskNotation[1]['valueStart'] && calcul<riskNotation[1]['valueEnd']):
            theRisk.innerHTML = riskNotation[1]['Name']
            break;
        case (calcul>riskNotation[2]['valueStart'] && calcul<riskNotation[2]['valueEnd']):
            theRisk.innerHTML = riskNotation[2]['Name']
            break;
        case (calcul>riskNotation[3]['valueStart'] && calcul<riskNotation[3]['valueEnd']):
            theRisk.innerHTML = riskNotation[3]['Name']
            break;
    }
}