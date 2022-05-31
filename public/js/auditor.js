var i = 5;

var j = 2;

function addDate(date, start_hour, end_hour) {
    document.querySelector("#datetimes").insertAdjacentHTML('beforeend','<div class="form-group row" id="dates"> <label for="auditDates" class="col-3 col-form-label">Date (' + j +')</label> <div class="col-8"> <input name="auditDates[]" type="date" value="' + date +'" class="form-control"> </div> <div class="col-1">\n' +
        '                <a href= SERVER_URL + "/auditor/intro/delete_date/' + date +'" class="btn btn-secondary form-control">-</a>\n' +
        '            </div> </div> <div class="form-group row"> <div class="col-1"></div> <label for="auditStartHour' + j +'" class="col-2 col-form-label">Heure de début</label> <div class="col-9"> <input name="auditStartHour' + j +'" value="' + start_hour +'" type="time"class="form-control" id="auditStartHour' + j +'"> </div></div> <div class="form-group row"> <div class="col-1"></div> <label for="auditEndHour' + j +'" class="col-2 col-form-label">Heure de fin</label> <div class="col-9"> <input name="auditEndHour' + j +'" value="' + end_hour +'" type="time" class="form-control"id="auditEndHour' + j +'"> </div></div>')
    j++};

$("#add-date").click(function () {
    $("#datetimes").append('<div class="form-group row" id="dates"> <label for="auditDates" class="col-3 col-form-label">Date (' + j +')</label> <div class="col-9"> <input name="auditDates[]" type="date" class="form-control"> </div> <div class="col-1">  </div> </div> <div class="form-group row"> <div class="col-1"></div> <label for="auditStartHour' + j +'" class="col-2 col-form-label">Heure de début</label> <div class="col-9"> <input name="auditStartHour' + j +'" value="" type="time"class="form-control" id="auditStartHour' + j +'"> </div></div> <div class="form-group row"> <div class="col-1"></div> <label for="auditEndHour' + j +'" class="col-2 col-form-label">Heure de fin</label> <div class="col-9"> <input name="auditEndHour' + j +'" value="" type="time" class="form-control"id="auditEndHour' + j +'"> </div></div>')
    j++});

$("#add-participant").click(function () {
    $('#participants-body').append("                    <tr>\n" +
        "                        <td><input type=\'text\' name=\'participantN[]\' class=\'form-control\'></td>\n" +
        "                        <td><input type=\'text\' name=\'participantP[]\' class=\'form-control\'></td>\n" +
        "                        <td><input type=\'text\' name=\'participantF[]\' class=\'form-control\'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\'  value=\"1\" name=\'presenceStep1-" + i + "\'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\'  value=\"1\" name=\'presenceStep2-" + i + "\'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\'  value=\"1\" name=\'presenceStep3-" + i + "\'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\'  value=\"1\" name=\'presenceStep4-" + i + "\'></td>\n" +
        "                    </tr>\n")
    i++;
});

function addParticipant(id, name, firstname, p_function, s1, s2, s3, s4, role) {
    if(s1 == 1){s1 = 'checked'}else{s1 = ''}
    if(s2 == 1){s2 = 'checked'}else{s2 = ''}
    if(s3 == 1){s3 = 'checked'}else{s3 = ''}
    if(s4 == 1){s4 = 'checked'}else{s4 = ''}
    if(role === 'auditor'){
    document.querySelector("#participants-body").insertAdjacentHTML('beforeend',"                    <tr>\n" +
        "                        <td><input type=\'text\' name=\'participantN[]\' value='" + name +"' class='form-control'></td>\n" +
        "                        <td><input type=\'text\' name=\'participantP[]\' value='" + firstname +"' class='form-control'></td>\n" +
        "                        <td><input type=\'text\' name=\'participantF[]\' value='" + p_function +"' class='form-control'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s1 +" value=\"1\" name=\'presenceStep1-" + i + "\'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s2 +" value=\"1\" name=\'presenceStep2-" + i + "\'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s3 +" value=\"1\" name=\'presenceStep3-" + i + "\'></td>\n" +
        "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s4 +" value=\"1\" name=\'presenceStep4-" + i + "\'></td>\n" +
        "                         <td><a href= SERVER_URL + '/auditor/intro/delete_participant/" + id +"' class='btn btn-secondary form-control' value='" + id + "'>-</a></td>\n" +
        "                    </tr>\n")
}else {
        document.querySelector("#participants-body").insertAdjacentHTML('beforeend',"                    <tr>\n" +
            "                        <td><input type=\'text\' name=\'participantN[]\' value='" + name +"' class='form-control'></td>\n" +
            "                        <td><input type=\'text\' name=\'participantP[]\' value='" + firstname +"' class='form-control'></td>\n" +
            "                        <td><input type=\'text\' name=\'participantF[]\' value='" + p_function +"' class='form-control'></td>\n" +
            "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s1 +" value=\"1\" name=\'presenceStep1-" + i + "\'></td>\n" +
            "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s2 +" value=\"1\" name=\'presenceStep2-" + i + "\'></td>\n" +
            "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s3 +" value=\"1\" name=\'presenceStep3-" + i + "\'></td>\n" +
            "                        <td class=\'align-middle participant\'><input class=\'form-control\' type=\'checkbox\' " + s4 +" value=\"1\" name=\'presenceStep4-" + i + "\'></td>\n" +
            "                    </tr>\n")
    }
    i++};

