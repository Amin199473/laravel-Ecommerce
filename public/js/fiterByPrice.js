//script filter by price in category page
if (document.getElementById('min-price') && document.getElementById('max-price')) {
    let slider = document.getElementById('slider');
    let minPrice = document.getElementById('min-price').value;
    let maxPrice = document.getElementById('max-price').value;

    noUiSlider.create(slider, {
        start: [Math.round(minPrice), Math.round(maxPrice)],
        connect: true,
        range: {
            'min': Math.round(minPrice),
            'max': Math.round(maxPrice),
        },
        pips: {
            mode: 'steps',
            stepped: true,
            density: 4
        }
    });
    slider.noUiSlider.on('update', () => {
        let sliderRange = slider.noUiSlider.get();
        document.getElementById('min').value = '$' + sliderRange[0];
        document.getElementById('max').value = '$' + sliderRange[1];
    });

}
