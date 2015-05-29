(function() {

    var dndHandler = {

        draggedElement: null,

        applyDragEvents: function(element) {

            element.draggable = true;

            var dndHandler = this;

            element.addEventListener('dragstart', function(e) {
                dndHandler.draggedElement = e.target;
                e.dataTransfer.setData('text/plain', '');
            }, false);

        },

        applyDropEvents: function(dropper) {

            dropper.addEventListener('dragover', function(e) {
                e.preventDefault(); // DROP autorisé
            }, false);

            var dndHandler = this;

            dropper.addEventListener('drop', function(e) {

                var target = e.target,
                    draggedElement = dndHandler.draggedElement,
                    clonedElement = draggedElement.cloneNode(true);

                while(target.className.indexOf('dropper') == -1) {
                    target = target.parentNode;
                }

                clonedElement = target.appendChild(clonedElement);
                dndHandler.applyDragEvents(clonedElement);

                draggedElement.parentNode.removeChild(draggedElement);

            });

        }

    };

    var elements = document.querySelectorAll('.draggable'),
        elementsLen = elements.length;

    for(var i = 0 ; i < elementsLen ; i++) {
        dndHandler.applyDragEvents(elements[i]);
    }

    var droppers = document.querySelectorAll('.dropper'),
        droppersLen = droppers.length;

    for(var i = 0 ; i < droppersLen ; i++) {
        dndHandler.applyDropEvents(droppers[i]);
    }

})();

