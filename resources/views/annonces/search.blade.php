<style>
.pagination-links nav {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-links .page-link {
    display: inline-block;
    padding: 8px 12px;
    margin: 0 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-decoration: none;
    color: #555;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
}

.pagination-links .page-link:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination-links .page-item.active .page-link {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}
</style>

<div class="pagination-links">
    {{ $annonces->links() }}
</div>