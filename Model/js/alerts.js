function alertSuccess(headerMessage,bodyMessage){
			Swal.fire(
			  headerMessage,
			  bodyMessage,
			  'success'
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
