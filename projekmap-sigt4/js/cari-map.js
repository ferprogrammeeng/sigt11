const view_map = document.querySelectorAll("tbody tr td a.view_map");

view_map.forEach(el => {
  el.addEventListener('click', () => {
    const id = el.id.split('-')[1];
    const name = document
      .querySelector(`tr#row-${id} td[data-name]`)
      .dataset.name;

    const content = `<h5>${name}</h5>`;
    const lat = parseFloat(el.dataset.lat);
    const lng = parseFloat(el.dataset.lng);
    const center = { lat, lng };

    map.setCenter(center);

    infoWindow.setPosition({ lat, lng });
    infoWindow.setContent(content);
    infoWindow.open(map);
  });
});
