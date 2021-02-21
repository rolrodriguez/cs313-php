
/**
 *  Add a notification for each delete button
 */
function assignDeletes() {
  let iconDeletes = document.querySelectorAll('.icon-delete');
  let myPath = location.pathname; 
  iconDeletes.forEach(icon => {
    icon.addEventListener('click', (e) => {
      swal({
        title: "Do you want to delete it this record?",
        text: "Are you sure?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then(response => {
        let part = myPath.split('/');
        let len = part.length
        let comp = part[len - 1];
        switch (comp) {
          case "journalentries.php":
            if (response) {
              swal("The journal entry were deleted").then(() => {
              location.href = './deletejournalentry.php?'+icon.dataset.id+'&'+icon.dataset.journalid;
              });
            }
          break;
          
          case "journals.php":
            if (response) {
              swal("The journal was deleted").then(() => {
              location.href = './deletejournal.php?'+icon.dataset.id;
              });
            }
            break;
          
          case "vaultbuckets.php":
            if (response) {
              swal("The vault bucket was deleted").then(() => {
              location.href = './deletevaultbucket.php?'+icon.dataset.id;
              });
            }
            break;
          
          case "vaultbucketentries.php":
            if (response) {
              swal("The bucket entry was deleted").then(() => {
              location.href = './deletevaultbucketentry.php?'+icon.dataset.id+'&'+icon.dataset.vaultid;
              });
            }
          break;
        }
        
      });
      
    });

  });
}
assignDeletes();

// Variables to hold the status of each validation
let checkUserFlag = false;
let verifyPasswordFlag = false;
// False means not problems

/**
 * Checks if the user exists in the database
 * if it doesn't exists then it will disable the submit button
 */
function checkUserExists() {
  let username = document.querySelector('#register-username');
  username.oninput = function () {
    let alertUsername = document.querySelector('#alert-username');
    let registerButton = document.querySelector('#register-button');
    let user = username.value;
    if (user.length > 3) {
      fetch("./userExists.php?username=" + user)
        .then(response => response.json())
        .then(data => {
          
          let resp = JSON.parse(data);
          if (resp) {
            alertUsername.setAttribute('class', 'alert');
            alertUsername.innerHTML = 'User exists <i class="fa fa-ban">';
            checkUserFlag = true;
            if (checkUserFlag || verifyPasswordFlag) {
              registerButton.disabled = true;  
            }
            
          }
          else {
            alertUsername.setAttribute('class', 'alert-green');
            alertUsername.innerHTML = 'User does not exist <i class="fa fa-check-circle-o">';
            checkUserFlag = false;
            if (!checkUserFlag && !verifyPasswordFlag) {
              registerButton.disabled = false;  
            }
            
          }
        });
    }
    else {
      alertUsername.removeAttribute('class');
      alertUsername.innerHTML = '';

    }
    
  }
}
checkUserExists();


/**
 * Checks if the password and the confirmation are equal
 */
function verifyPassword() {
  let password = document.querySelector('#register-password');
  let passwordConf = document.querySelector('#register-password-confirmation');
  let alertPassword = document.querySelector('#alert-verify-password');
  let registerButton = document.querySelector('#register-button');

  passwordConf.oninput = function () {

    if (password.value != passwordConf.value) {
    alertPassword.setAttribute('class', 'alert');
    alertPassword.innerHTML = 'Passwords do not match <i class="fa fa-ban">';
    verifyPasswordFlag = true;
    if (checkUserFlag || verifyPasswordFlag) {
              registerButton.disabled = true;  
    }
    }
    else {
      alertPassword.setAttribute('class', 'alert-green');
      alertPassword.innerHTML = 'Passwords match <i class="fa fa-check-circle-o">';
      verifyPasswordFlag = false;
      if (!checkUserFlag && !verifyPasswordFlag) {
        registerButton.disabled = false;
      }
    }
  }
  
}
verifyPassword();

