let iconDeletes = document.querySelectorAll('.icon-delete');
let myPath = location.pathname; 
iconDeletes.forEach(icon => {
  icon.addEventListener('click', (e) => {
    swal({
      title: "Do you want to delete it?",
      text: "Are you sure you want this to be deleted?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then(response => {

      switch (myPath) {
        case "/journalentries.php":
          if (response) {
            swal("The records were deleted").then(() => {
            location.href = './deletejournalentry.php?'+icon.dataset.id+'&'+icon.dataset.journalid;
            });
          }
        break;
        
        case "/journals.php":
          if (response) {
            swal("The records were deleted").then(() => {
            location.href = './deletejournal.php?'+icon.dataset.id;
            });
          }
          break;
        
        case "/vaultbuckets.php":
          if (response) {
            swal("The records were deleted").then(() => {
            location.href = './deletevaultbucket.php?'+icon.dataset.id;
            });
          }
          break;
        
        case "/vaultbucketentries.php":
          if (response) {
            swal("The records were deleted").then(() => {
            location.href = './deletevaultbucketentry.php?'+icon.dataset.id+'&'+icon.dataset.vaultid;
            });
          }
        break;
      }
      
    });
    
  });

});

