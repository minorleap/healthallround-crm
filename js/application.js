// JavaScript Document

// JQuery Validate Additional Methods

// Checks a string to see if it in a valid UK date format
// of (D)D/(M)M/(YY)YY and returns true/false
function isValidUKDate(s) {
// format D(D)/M(M)/(YY)YY
  var dateFormat = /^\d{1,4}[\.|\/|-]\d{1,2}[\.|\/|-]\d{1,4}$/;

  if (dateFormat.test(s)) {
      // remove any leading zeros from date values
      s = s.replace(/0*(\d*)/gi,"$1");
      var dateArray = s.split(/[\.|\/|-]/);

      // correct month value
      dateArray[1] = dateArray[1]-1;

      // correct year value
      if (dateArray[2].length<4) {
          // correct year value
          dateArray[2] = (parseInt(dateArray[2]) < 50) ? 2000 + parseInt(dateArray[2]) : 1900 + parseInt(dateArray[2]);
      }

      var testDate = new Date(dateArray[2], dateArray[1], dateArray[0]);
      if (testDate.getDate()!=dateArray[0] || testDate.getMonth()!=dateArray[1] || testDate.getFullYear()!=dateArray[2]) {
          return false;
      } else {
          return true;
      }
  } else {
      return false;
  }
}

function isValidTime(s) {
	var timeFormat = /^\d{2}:\d{2}$/;
	if (timeFormat.test(s)) {
		var timeArray = s.split(':');
		var validHours = 0 <= timeArray[0] && timeArray[0] < 24;
		var validMins = 0 <= timeArray[1] && timeArray[1] < 60;
		return validHours && validMins;
	}
}

function isValidPostcode(s) {
	var postcodeFormat = /^([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z])))) ?[0-9][A-Za-z]{2})$/;
	return postcodeFormat.test(s);
}

jQuery.validator.addMethod('ukdate', function (value, element) {
	if (this.optional(element)) {return true;}
	return isValidUKDate(value);
});

jQuery.validator.addMethod('postcode', function (value, element) {
	if (this.optional(element)) {return true;}
	return isValidPostcode(value);
});

jQuery.validator.addMethod('time', function (value, element) {
	if (this.optional(element)) {return true;}
	return isValidTime(value);
});