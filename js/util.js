function validateForm(myform){
	var err = true;
	var getclass;
	var getid;
	var elements = myform.elements;
	for (i=0; i<elements.length; i++){
		getclass = elements[i].className;
		getid = elements[i].id;
		if(getclass.indexOf('validate:string') >= 0)
			err = validateString(myform,getid,getid,'reqfield',err);
		if(getclass.indexOf('validate:index') >= 0)
			err = validateIndex(myform,getid,getid,'reqfield',err);
		if(getclass.indexOf('validate:email') >= 0)
			err = validateEmail(myform,getid,getid,'reqfield',err);
		if(getclass.indexOf('validate:min') >= 0)
			err = validateMin(myform,getid,getid,'reqfield',err);
	}
	if (err != true){
		newstr = document.getElementById('notify').className.replace("hidden","")
		document.getElementById('notify').className = newstr;
		return false;
	}
}

function validateString(myform,objname,objid,class_name,err){
	resetClass(objid,class_name);
	var val = myform[objname].value;
	val = val.trim();
	if(val==''){
		var c_class = document.getElementById(objid).className;
		document.getElementById(objid).className = c_class + " " + class_name;
		return false;
	}
	return err;
}

function validateIndex(myform,objname,objid,class_name,err){
	resetClass(objid,class_name);
	var val = myform[objname].selectedIndex ;
	if(val==0){
		var c_class = document.getElementById(objid).className;
		document.getElementById(objid).className = c_class + " " + class_name;
		return false;
	}
	return err;
}

function validateEmail(myform,objname,objid,class_name,err){
	resetClass(objid,class_name);
	var val = myform[objname].value;
	var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(reg.test(val)==false){
		var c_class = document.getElementById(objid).className;
		document.getElementById(objid).className = c_class + " " + class_name;
		return false;
	}
	return err;
}

function validateMin(myform,objname,objid,class_name,err){
	resetClass(objid,class_name);
	var val = myform[objname].value.length;
	if(val>0 && val<3){
		var c_class = document.getElementById(objid).className;
		document.getElementById(objid).className = c_class + " " + class_name;
		return false;
	}
	return err;
}

function resetClass(objid, class_name){
	var newstr = document.getElementById(objid).className.replace(class_name,"");
	document.getElementById(objid).className = newstr;
}

function setClass(objid, class_name){
	var newstr = document.getElementById(objid).className;
	document.getElementById(objid).className = newstr + ' ' + class_name;
}

function validateDateFormat(myform,objname,objid,format,class_name,err){
	if(myform[objname].value){
		resetClass(objid,class_name);
		var date_format = format.replace(/[^\W]/g, '');
		var form_val = myform[objname].value.replace(/[^\W]/g, '');
		var numaric = myform[objname].value.replace(/[\d\W]/g, '')
		if(form_val != date_format || numaric != ''){
			var c_class = document.getElementById(objid).className;
			document.getElementById(objid).className = c_class + " " + class_name;
			return false;
		}
		return err;
	}
	return err;
}

function printDiv(divName) {
	 var printContents = document.getElementById(divName).innerHTML;
	 var originalContents = document.body.innerHTML;
	 document.body.innerHTML = printContents;
	 window.print();
	 document.body.innerHTML = originalContents;
}

function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function dismissNotify(divid){
	setClass(divid, 'hidden');
}
/*
function date_time999(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+d+'/'+months[month]+'/'+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}

function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        d = date.getDate();
        day = date.getDay();
        days = new Array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', 
						'13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        h = date.getHours();
		m = date.getMinutes()-5;
		s = date.getSeconds();
		
		  //var hours = date.getHours();
		  //var minutes = date.getMinutes();
		  ampm = h >= 12 ? 'pm' : 'am';
		  h = h % 12;
		  h = h ? h : 12; // the hour '0' should be '12'
		  m = m < 10 ? '0'+m : m;
		  strTime = h + ':' + m + ' ' + ampm;
		  
		  /*
        if(h<10)
        {
                h = "0"+h;
        }
       
        if(m<10)
        {
                m = "0"+m;
        }
        
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+'/'+months[month]+'/'+year+' '+h+':'+m+':'+s+' '+ampm;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
} 
*/