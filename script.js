let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");


closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
});


// following are the code to change sidebar button(optional)
function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
    }
}

function toggleCodeBox() {
    var codeBox = document.getElementById("codeBox");
    //toggle between the visibility of code box. check whether div has the class d-none or not
    if (codeBox.classList == "d-none") {
        codeBox.classList = "";
    } else {
        codeBox.classList = "d-none";
    }
}

function toggleSubjectField() {
    var subjectBox = document.getElementById("subjectBox");
    //toggle between the visibility of code box. check whether div has the class d-none or not
    if (subjectBox.className == "d-none") {
        subjectBox.className = "";
    } else {
        subjectBox.className = "d-none";
    }
}
var tbox = document.getElementById('textBox');
var abox = document.getElementById('alertBox');
var sbox = document.getElementById('signBox');

//signout process
function SignOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "index.php"; //after a successful sign out, return to index
            }
        }
    }
    r.open("GET", "signout.php", true);
    r.send();
}
//signin functions
function adminSignIn() {

    var un = document.getElementById("un").value;
    var pw = document.getElementById("pw").value;
    tbox = document.getElementById('textBox');
    abox = document.getElementById('alertBox');
    sbox = document.getElementById('signBox');

    var form = new FormData();

    form.append("un", un);
    form.append("pw", pw);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "dashboard.php";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }

        }
    }
    r.open("POST", "./tasks/signinProcess.php", true);
    r.send(form);
}

function OfficerSignIn() {
    var uname = document.getElementById("uname").value;
    var password = document.getElementById("password").value;
    var code = document.getElementById("code").value;
    tbox = document.getElementById('textBox');
    abox = document.getElementById('alertBox');
    sbox = document.getElementById('signBox');

    var form = new FormData();

    form.append("un", uname);
    form.append("pw", password);
    form.append("code", code);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "dashboard.php";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }

        }
    }
    r.open("POST", "./tasks/officerSigninProcess.php", true);
    r.send(form);

}

function TeacherSignIn() {
    var uname = document.getElementById("uname").value;
    var password = document.getElementById("password").value;
    var code = document.getElementById("code").value;
    tbox = document.getElementById('textBox');
    abox = document.getElementById('alertBox');
    sbox = document.getElementById('signBox');
    var form = new FormData();

    form.append("un", uname);
    form.append("pw", password);
    form.append("code", code);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "dashboard.php";
            } else {
                abox.className = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }

        }
    }
    r.open("POST", "./tasks/teacherSigninProcess.php", true);
    r.send(form);

}

function studentSignIn() {
    var uname = document.getElementById("un").value;
    var password = document.getElementById("pw").value;
    var code = document.getElementById("code").value;
    tbox = document.getElementById('textBox');
    abox = document.getElementById('alertBox');
    sbox = document.getElementById('signBox');

    var form = new FormData();

    form.append("un", uname);
    form.append("pw", password);
    form.append("code", code);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "dashboard.php";
            } else {
                abox.className = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }

        }
    }
    r.open("POST", "./tasks/studentSigninProcess.php", true);
    r.send(form);
}
//signin functions



//teacher registration called by admin
function registerOfficer() {
    var aid = document.getElementById("aid").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var uname = document.getElementById("uname").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var status = document.getElementById("status").value;

    var form = new FormData();

    form.append("aid", aid);
    form.append("fname", fname);
    form.append("lname", lname);
    form.append("uname", uname);
    form.append("email", email);
    form.append("password", password);
    form.append("status", status);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");
            var text = r.responseText;
            if (text == "success") {
                abox.className = "alert-success border-start border-success border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = 'bi bi-check-circle-fill'
                tbox.innerHTML = "New Academic officer Registered Successfully";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }
        }
    }
    r.open("POST", "./tasks/registerOfficerProcess.php", true);
    r.send(form);
}

//teacher registration called by admin
function registerTeacher() {
    //get all ids
    var tid = document.getElementById("tid").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var uname = document.getElementById("uname").value;
    var gender = document.getElementById("gender").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var status = document.getElementById("status").value;

    var form = new FormData();

    form.append("tid", tid);
    form.append("fname", fname);
    form.append("lname", lname);
    form.append("uname", uname);
    form.append("gender", gender);
    form.append("email", email);
    form.append("password", password);
    form.append("status", status);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            //get by ids
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");
            if (text == "success") {
                //add class lists
                abox.className = "alert-success border-start border-success border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = 'bi bi-check-circle-fill'
                tbox.innerHTML = "New Teacher Registered Successfully";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }
        }
    }
    r.open("POST", "./tasks/registerTeacherProcess.php", true);
    r.send(form);
}
//teacher registration called by academic
function registerStudent() {
    var sid = document.getElementById("eid").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var uname = document.getElementById("uname").value;
    var grade = document.getElementById("g").value;
    var bday = document.getElementById("bday").value;
    var gender = document.getElementById("gender").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var status = document.getElementById("status").value;

    var form = new FormData();

    form.append("sid", sid);
    form.append("fname", fname);
    form.append("lname", lname);
    form.append("uname", uname);
    form.append("grade", grade);
    form.append("bday", bday);
    form.append("gender", gender);
    form.append("email", email);
    form.append("password", password);
    form.append("status", status);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");
            var text = r.responseText;
            if (text == "success") {
                abox.className = "alert-success border-start border-success border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = 'bi bi-check-circle-fill'
                tbox.innerHTML = "New Student Registered Successfully";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }
        }
    }
    r.open("POST", "./tasks/registerStudentProcess.php", true);
    r.send(form);
}
//add subject function
function addSubject() {
    var subject = document.getElementById("subject").value;

    var form = new FormData();

    form.append("sub", subject);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");

            if (text == "success") {
                window.location = "addSubject.php";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }

        }
    }
    r.open("POST", "./tasks/addSubjectProcess.php", true);
    r.send(form);
}


//addign grade function
function addGrade() {
    var grade = document.getElementById("grade").value;

    var form = new FormData();

    form.append("g", grade);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");
            var text = r.responseText;

            if (text == "success") {
                window.location = "addGrade.php";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }

        }
    }
    r.open("POST", "./tasks/addGradeProcess.php", true);
    r.send(form);
}

//assign teacher with a subject and a grade function
function assignTeacher() {
    //get value from ids
    var t = document.getElementById("t").value;
    var g = document.getElementById("g").value;
    var s = document.getElementById("s").value;
    //send as a form
    var form = new FormData();

    form.append("t", t);
    form.append("g", g);
    form.append("s", s);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");

            if (text == "success") {
                window.location = "subjectCombination.php";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }

        }
    }
    r.open("POST", "./tasks/assignTeacherProcess.php", true);
    r.send(form);
}

//assignment uploading process done by the teacher
function uploadAssignment() {
    //get value from ids
    var aname = document.getElementById("aname").value;
    var tsgid = document.getElementById("tsgid").value;
    var dur = document.getElementById("dur").value;
    var deadl = document.getElementById("deadl").value;
    var file = document.getElementById("file");

    //create form
    var form = new FormData();

    form.append("aname", aname);
    form.append("tsgid", tsgid);
    form.append("dur", dur);
    form.append("deadl", deadl);
    form.append("file", file.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                //will reload the current page
                window.location = "uploadAssignment.php";
            } else {
                alert(text);
            }

        }
    }
    r.open("POST", "./tasks/uploadAssignmentProcess.php", true);
    r.send(form);

}

//called from the download assignment page. will open up a model 
function uploadModel(id) {
    var model = document.getElementById("uploadAns" + id);
    md = new bootstrap.Modal(model);
    md.show();
}


//this function will send the answer pdf of the user
function uploadAnswers(aid) {
    var ansFile = document.getElementById("ansFile" + aid);

    var form = new FormData();

    form.append("aid", aid);
    form.append("ansFile", ansFile.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");

            if (text == "success") {


                window.location = "downloadAssignment.php";
            } else {
                alert(text);
            }

        }
    }
    r.open("POST", "./tasks/uploadAnswersProcess.php", true);
    r.send(form);
}

//this function will upload lessons. called by the teacher
function uploadLessons() {
    var tsgid = document.getElementById("tsgid").value;
    var desc = document.getElementById("desc").value;
    var file = document.getElementById("file");

    var form = new FormData();

    form.append("tsgid", tsgid);
    form.append("desc", desc);
    form.append("file", file.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "uploadLesson.php";
            } else {
                alert(text);
            }

        }
    }
    r.open("POST", "./tasks/uploadLessonsProcess.php", true);
    r.send(form);
}
//this function will search lesson according to the subject and students current grade. called by the student
function searchLessons() {
    var subject = document.getElementById("subject").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            var sbox = document.getElementById("subjectBox");
            sbox.innerHTML = " ";
            sbox.innerHTML = text;

        }
    }
    r.open("GET", "./tasks/searchLessonsProcess.php?s=" + subject, true);
    r.send();
}
var md;

//called when download answers page loads. model will allow the teacher to select the assignment
function showAnsModal() {
    var model = document.getElementById("showAnsModal");
    md = new bootstrap.Modal(model);
    md.show();
}

function ansSearch() {
    var ass = document.getElementById("ass").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            var sbox = document.getElementById("ansBox");
            sbox.innerHTML = " ";
            sbox.innerHTML = text;
            md.hide();

        }
    }
    r.open("GET", "./tasks/searchAnswersProcess.php?ass=" + ass, true);
    r.send();
}
//teacher can search for answer sheets by student name
function searchByStudent(id) {
    var sname = document.getElementById("sname").value;

    var form = new FormData();
    form.append("ass_id", id);
    form.append("sname", sname);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            var sbox = document.getElementById("ansBox");
            sbox.innerHTML = " ";
            sbox.innerHTML = text;


        }
    }
    r.open("POST", "./tasks/searchAnswersByStudentProcess.php", true);
    r.send(form);
}
//this function will bring students who has submit answers to the selected assignment. so that teacher can submit answers
function bringStudents() {
    var ass = document.getElementById("ass").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            var sname = document.getElementById("sname");
            sname.innerHTML = " ";
            sname.innerHTML = text;


        }
    }
    r.open("GET", "./tasks/bringStudentResults.php?id=" + ass, true);
    r.send();
}

//this function will save the results. will be displayed to the academic officer

function submitResult() {
    var ass = document.getElementById("ass").value;
    var sname = document.getElementById("sname").value;
    var marks = document.getElementById("marks").value;

    var form = new FormData();
    form.append("ass", ass);
    form.append("sname", sname);
    form.append("marks", marks);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "submitResults.php";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }



        }
    }
    r.open("POST", "./tasks/submitResultsProcess.php", true);
    r.send(form);
}

//searching assignment results in officers dashboard

function assignmentSearch() {
    var ass = document.getElementById("ass").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            var results = document.getElementById("results");
            results.innerHTML = " ";
            results.innerHTML = text;
            md.hide();


        }
    }
    r.open("POST", "./tasks/assignmentResultsProcess.php?id=" + ass, true);
    r.send();
}

// change the status of the assignment marks 0 to 1

function marksStatesChanged(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            var s = document.getElementById("s");
            s.classList = "badge rounded-pill alert-success";
            s.innerHTML = "Released";


        }
    }
    r.open("GET", "./tasks/changeMarksStatus.php?id=" + id, true);
    r.send();
}

// update teacher profile
function updateTeacher(id) {
    var un = document.getElementById("tun").value;
    var fn = document.getElementById("tfn").value;
    var ln = document.getElementById("tln").value;

    var form = new FormData();
    form.append("un", un);
    form.append("fn", fn);
    form.append("ln", ln);
    form.append("id", id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");
            if (text == "success") {

                abox.className = "alert-success border-start border-success border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = 'bi bi-check-circle-fill'
                tbox.innerHTML = "Teacher profile Updated Successfully";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }


        }
    }
    r.open("POST", "./tasks/updateProfileProcess.php", true);
    r.send(form);
}

// update officer profile
function updateOfficer(id) {
    var un = document.getElementById("aun").value;
    var fn = document.getElementById("afn").value;
    var ln = document.getElementById("aln").value;

    var form = new FormData();
    form.append("un", un);
    form.append("fn", fn);
    form.append("ln", ln);
    form.append("id", id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");
            if (text == "success") {

                abox.className = "alert-success border-start border-success border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = 'bi bi-check-circle-fill'
                tbox.innerHTML = "Officer profile Updated Successfully";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }


        }
    }
    r.open("POST", "./tasks/updateProfileProcess.php", true);
    r.send(form);
}
//update student profile
function updateStudent(id) {
    var un = document.getElementById("sun").value;
    var fn = document.getElementById("sfn").value;
    var ln = document.getElementById("sln").value;

    var form = new FormData();
    form.append("un", un);
    form.append("fn", fn);
    form.append("ln", ln);
    form.append("id", id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            abox = document.getElementById("alertBox");
            tbox = document.getElementById("textBox");
            sbox = document.getElementById("signBox");
            if (text == "success") {

                abox.className = "alert-success border-start border-success border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = 'bi bi-check-circle-fill'
                tbox.innerHTML = "Student profile Updated Successfully";
            } else {
                abox.classList = "alert-danger border-start border-danger border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = "bi bi-exclamation-octagon-fill";
                tbox.innerHTML = text;
            }


        }
    }
    r.open("POST", "./tasks/updateProfileProcess.php", true);
    r.send(form);
}
//this model will be called by the admin to change thee grade. 
function updateGModel(id) {

    var model = document.getElementById("exampleModal" + id);
    md = new bootstrap.Modal(model);
    md.show();
}
//this function will be called when the student select a subject when he looking for his results
function bringAsignments(id) {
    var sub_id = document.getElementById("subject").value;

    var form = new FormData();
    form.append("g", id);
    form.append("s", sub_id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            var s = document.getElementById("aSelect");
            s.innerHTML = text;


        }
    }
    r.open("POST", "./tasks/bringAssignmentProcess.php", true);
    r.send(form);
}
//this function will search for results

function searchResults(id) {
    var ass = document.getElementById("aSelect").value;
    var subject = document.getElementById("subject").value;

    var form = new FormData();
    form.append("stu", id);
    form.append("ass", ass);
    form.append("sub", subject);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            var rbox = document.getElementById("rBox");
            rbox.innerHTML = text;


        }
    }
    r.open("POST", "./tasks/bringResultsProcess.php", true);
    r.send(form);
}

//this function will update student grade. called by the admin
function upgradeSGrade(sid) {

    var gid = document.getElementById("ngr" + sid).value;
    var form = new FormData();
    form.append("sid", sid);
    form.append("gid", gid);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "manageStudent.php";
                md.hide()
            } else {
                alert(text);
            }


        }
    }
    r.open("POST", "./tasks/updateStudentGradeProcess.php", true);
    r.send(form);
}

//this function will change the payment status of the student
function paymentStatus(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "manageStudent.php";

            }


        }
    }
    r.open("GET", "./tasks/paymentStatusProcess.php?id=" + id, true);
    r.send();
}
var mod;
//this function will be called by student, teacher, officer to change their password when they are loggedin
function openPasswordModel() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            abox = document.getElementById("mBox");
            tbox = document.getElementById("tBox");
            sbox = document.getElementById("sBox");
            var text = r.responseText;

            if (text == "success") {

                abox.className = "alert-success border-start border-success border-5 d-flex align-items-center pt-3 pb-3 ps-2"
                sbox.className = 'bi bi-check-circle-fill'
                tbox.innerHTML = "We have sent an verification code to your email";
                var model = document.getElementById("studentpasswordModel");
                mod = new bootstrap.Modal(model);
                mod.show();

            } else {
                alert(text);
            }


        }
    }
    r.open("GET", "./tasks/sendVerificationProcess.php", true);
    r.send();

}
//this function will change the password
function changepassword() {
    var code = document.getElementById("c").value;
    var nw = document.getElementById("nw").value;
    var cw = document.getElementById("cw").value;

    var form = new FormData();

    form.append("code", code);
    form.append("nw", nw);
    form.append("cw", cw);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "settings.php";

            } else {
                alert(text);
            }


        }
    }
    r.open("POST", "./tasks/changePasswordProcess.php", true);
    r.send(form);
}

//this function will popup a confirmation model before blocking teacher
function teacherStatusModel(id) {
    var model = document.getElementById("TeacherStatusModel" + id);
    var mod = new bootstrap.Modal(model);
    mod.show();
}
//this function will block a teacher account
function teacherStatusChange(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "manageTeacher.php";

            } else {
                alert(text);
            }


        }
    }
    r.open("GET", "./tasks/teacherStatusChangeProcess.php?id=" + id, true);
    r.send();
}


//this function will popup a confirmation model before blocking officer
function officerStatusModel(id) {
    var model = document.getElementById("OfficerStatusModel" + id);
    var mod = new bootstrap.Modal(model);
    mod.show();
}
//this function will block a academic account
function officerStatusChange(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "manageOfficer.php";

            } else {
                alert(text);
            }


        }
    }
    r.open("GET", "./tasks/officerStatusChangeProcess.php?id=" + id, true);
    r.send();
}


//this function will popup a confirmation model before blocking officer
function StudentStatusModel(id) {
    var model = document.getElementById("StudentStatusModel" + id);
    var mod = new bootstrap.Modal(model);
    mod.show();
}
//this function will block a student account
function StudentStatusChange(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "manageStudent.php";

            } else {
                alert(text);
            }


        }
    }
    r.open("GET", "./tasks/studentStatusChangeProcess.php?id=" + id, true);
    r.send();
}
//this function will be called when an academic officer click the forgot password option
function AcademicForgotPassword() {
    var un = document.getElementById("uname").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                var model = document.getElementById("academicForgotpasswordModel");
                var mod = new bootstrap.Modal(model);
                mod.show();

            } else {
                alert(text);
            }


        }
    }
    r.open("GET", "./tasks/officerForgetPasswordProcess.php?un=" + un, true);
    r.send();
}
//this function will be update the academic officer password 
function changeAcademicpassword() {
    var code = document.getElementById("c").value;
    var nw = document.getElementById("nw").value;
    var cw = document.getElementById("cw").value;

    var form = new FormData();

    form.append("code", code);
    form.append("nw", nw);
    form.append("cw", cw);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "signin.php?user=2";

            } else {
                alert(text);
            }


        }
    }
    r.open("POST", "./tasks/changeAcademicPasswordProcess.php", true);
    r.send(form);
}
//this function will be called when an student click the forgot password option
function studentForgotPassword() {
    var un = document.getElementById("un").value;
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                var model = document.getElementById("studentForgotpasswordModel");
                var mod = new bootstrap.Modal(model);
                mod.show();

            } else {
                alert(text);
            }


        }
    }
    r.open("GET", "./tasks/studentForgetPasswordProcess.php?un=" + un, true);
    r.send();
}
//this function will be update the student password 
function changeStudentpassword() {
    var code = document.getElementById("c").value;
    var nw = document.getElementById("nw").value;
    var cw = document.getElementById("cw").value;

    var form = new FormData();

    form.append("code", code);
    form.append("nw", nw);
    form.append("cw", cw);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "signin.php?user=3";

            } else {
                alert(text);
            }


        }
    }
    r.open("POST", "./tasks/changeStudentPasswordProcess.php", true);
    r.send(form);
}

//this function will be called when an student click the forgot password option
function teacherForgotPassword() {
    var un = document.getElementById("uname").value;
    alert(un)
    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                var model = document.getElementById("teacherForgotpasswordModel");
                var mod = new bootstrap.Modal(model);
                mod.show();

            } else {
                alert(text);
            }


        }
    }
    r.open("GET", "./tasks/teacherForgetPasswordProcess.php?un=" + un, true);
    r.send();
}

//this function will be update the student password 
function changeTeacherpassword() {
    var code = document.getElementById("c").value;
    var nw = document.getElementById("nw").value;
    var cw = document.getElementById("cw").value;

    var form = new FormData();

    form.append("code", code);
    form.append("nw", nw);
    form.append("cw", cw);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "signin.php?user=4";

            } else {
                alert(text);
            }


        }
    }
    r.open("POST", "./tasks/changeTeacherPasswordProcess.php", true);
    r.send(form);
}

//this function will display the teacher detail model will be called when admin click the view button of a teacher record
function displayTeacherDetails(id) {
    var model = document.getElementById("displayTeacherDetails" + id);
    var mod = new bootstrap.Modal(model);
    mod.show();
}

//this function will display the student detail model will be called when admin click the view button of a student record
function displayStudentDetails(id) {
    var model = document.getElementById("displayStudentDetails" + id);
    var mod = new bootstrap.Modal(model);
    mod.show();
}