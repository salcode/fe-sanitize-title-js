(function() {

	var testData = feSanitizeTitleDemo.testData,
		testDataLength = testData.length,
		outputHtml = '',
		passed = true,
		i, before, after, result;

	outputHtml = '<table><tr><th>Original</th><th>PHP sanitized</th><th>JS sanitized</th><th>Same Result</th></tr>';
	for ( i=0; i < testDataLength; i++ ) {
		before = testData[i].before;
		before_escaped = testData[i].before_escaped;
		after = testData[i].after;
		result = wpFeSanitizeTitle( before );

		if ( result !== after ) {
			passed = false;
		}

		outputHtml += '<tr><td>' + before_escaped + '</td><td>' +
			after + '</td><td>' + result +
			'</td><td>' + ( result === after ? 'Yes' : 'No' ) +
			'</td></tr>';
	}
	outputHtml += '</table>';

	outputHtml += '<h3 id="wp-fe-sanitize-title-js-result-pass">wpFeSantizeTitle() ' +
	( passed ? 'passes all tests' : 'fails' ) +
	', when compared to WordPress PHP sanitize_title()</h3>';

	var node = document.getElementById("wp-fe-sanitize-title-js-result");
	node.innerHTML = outputHtml;

})();
