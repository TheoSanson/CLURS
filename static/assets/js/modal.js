$(document).on('click', '.open-modal', function() {
    openModal();
    return 0;
});

$(document).on('click', '.close-modal', function() {
    closeModal();
    return 0;
});

$('.page-modal').on('click', function(e) {
    if (e.target !== this)
        return;
    closeModal();
});

function openModal(){
    let modal = document.getElementsByClassName('page-modal')[0];
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.overflow = 'auto';
}

function closeModal(){
    let modal = document.getElementsByClassName('page-modal')[0];
    modal.style.width = '0';
    modal.style.height = '0';
    modal.style.overflow = 'hidden';
}