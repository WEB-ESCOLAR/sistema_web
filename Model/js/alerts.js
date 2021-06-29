function alertModal(headerMessage,bodyMessage,type){
			Swal.fire(
			  headerMessage,
			  bodyMessage,
			  type
			)
		}



function alertWarning(title){
	Swal.fire({
		title: title,
		icon: 'warning',
		showCancelButton: false,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'atras'
	  })
}



 