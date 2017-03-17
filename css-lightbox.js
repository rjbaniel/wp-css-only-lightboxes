var anchors = document.getElementsByClassName('lightbox-overlay');
var anchorIDs = getLightboxAnchorIDs();
var numAnchors = anchorIDs.length;

for (var i = 0; i < anchors.length; i++) {
	anchors[i].addEventListener('click', closeLightboxClick);
}

if (anchorIDs.length >= 1) {
	window.addEventListener('keypress', closeLightboxEsc);
	if (anchorIDs.length >= 2) {
		window.addEventListener('keypress', navigateLightboxes);
	}
}

function navigateLightboxes(event) {
	var currentAnchor = window.location.hash;
	var currentAnchorIndex = anchorIDs.indexOf(currentAnchor);
	if (currentAnchorIndex != -1) {
		if (37 === event.keyCode) {
			prevLightbox(numAnchors, currentAnchorIndex);
		} else if (39 === event.keyCode) {
			nextLightbox(numAnchors, currentAnchorIndex);
		}
	}
}

function prevLightbox(numAnchors, currentAnchorIndex) {
	if (currentAnchorIndex === 0) {
		window.location.hash = anchorIDs[numAnchors -1 ];
	} else {
		window.location.hash = anchorIDs[currentAnchorIndex - 1];
	}
}

function nextLightbox(numAnchors, currentAnchorIndex) {
	if (currentAnchorIndex == numAnchors - 1) {
		window.location.hash = anchorIDs[0];
	} else {
		window.location.hash = anchorIDs[currentAnchorIndex + 1];
	}
}

function closeLightboxClick(event) {
	if ( anchorIDs.indexOf("#" + event.target.id) != -1 ) {
		window.location.hash = "#no-image";
	}
}

function closeLightboxEsc(event) {
	if ( 27 === event.keyCode ) {
		if ( anchorIDs.indexOf(window.location.hash) != -1 ) {
			window.location.hash = "#no-image";
		}
	}
}

function getLightboxAnchorIDs() {
	var anchorIDsReturn = [];
	for (var i = 0; i < anchors.length; i++) {
		anchorIDsReturn[i] = "#" + anchors[i].id;
	}
	return anchorIDsReturn;
}