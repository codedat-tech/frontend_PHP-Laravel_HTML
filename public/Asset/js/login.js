
function openPopup(popupId)
{
    const popup = document.getElementById(popupId);
    if (popup)
    {
        popup.style.display = 'block';  // Hiển thị popup
    }
}
function closePopup(popupId)
{
    const popup = document.getElementById(popupId);
    if (popup)
    {
        popup.style.display = 'none';  // Ẩn popup
    }
}