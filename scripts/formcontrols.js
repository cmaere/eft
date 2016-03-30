//------------------------------------------------------------------------
//								FORM CONTROLS SCRIPTS
//Developer
//charlie maere
//@2014
//------------------------------------------------------------------------


function delete_records(url)
{
	// this function gets an arrary of selected records from a display form list and deletes after a prompt to verify the delete action
	//alert("here");
	var p_ids = document.listform.elements["checkbox[]"];
	var is_checked = false;
	var len = p_ids.length;
	var arr = new Array(len);
	//alert("here " + p_ids.length);
	for (var i = 0; i < len; i++) 
	{
		
		if(p_ids[i].checked)
		{
			is_checked = true;
			arr[i] = p_ids[i].value;
		}
		
	  
	}
	
	
 
	if (is_checked == true) {
		if(confirm('Are you sure you want to delete these records?'))
		{
			 url = url + '&arr=' + JSON.stringify(arr);
			 window.location.href = url;
		}
		else 
		{
			
		}
	   
	    
	}
	else
	{
			alert('Please select at least 1 record to delete');
			window.location.href = url;
			
	}
}