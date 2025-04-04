
document.querySelectorAll('.edit-btn').forEach(btn => {
  btn.addEventListener('click', function() {
    // Get department data
    const id = this.getAttribute('data-id');
    const name = this.getAttribute('data-name');
    const description = this.getAttribute('data-description');
    
    // Fill form fields
    document.getElementById('modalDeptName').value = name;
    document.getElementById('modalDeptDesc').value = description;
    
    // Update form action URL
    document.getElementById('editDepartmentForm').action = `/admin/departments/${id}`;
  });
});
