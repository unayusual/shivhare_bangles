<?php
require_once 'includes/auth_check.php';
require_once '../config/db_connect.php';
require_once '../includes/functions.php';

// Handle Status Update
if (isset($_GET['mark_read'])) {
    $id = (int)$_GET['mark_read'];
    $pdo->prepare("UPDATE inquiries SET status = 'read' WHERE id = ?")->execute([$id]);
    header("Location: inquiries.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM inquiries WHERE id = ?")->execute([$id]);
    header("Location: inquiries.php");
    exit;
}

// Fetch Inquiries
$stmt = $pdo->query("
    SELECT i.*, p.name as product_name 
    FROM inquiries i 
    LEFT JOIN products p ON i.product_id = p.id 
    ORDER BY i.created_at DESC
");
$inquiries = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Customer Inquiries</h1>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Product Interest</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $row): ?>
                    <tr class="<?php echo $row['status'] == 'new' ? 'table-warning' : ''; ?>">
                        <td><small><?php echo date('M j, Y h:i A', strtotime($row['created_at'])); ?></small></td>
                        <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($row['email']); ?><br>
                            <?php echo htmlspecialchars($row['phone']); ?>
                        </td>
                        <td><?php echo $row['product_name'] ? htmlspecialchars($row['product_name']) : '<span class="text-muted">General</span>'; ?></td>
                        <td style="max-width: 300px;">
                             <button type="button" class="btn btn-sm btn-link p-0 text-start text-truncate d-inline-block w-100" data-bs-toggle="modal" data-bs-target="#msgModal<?php echo $row['id']; ?>">
                                <?php echo htmlspecialchars(substr($row['message'], 0, 50)) . '...'; ?>
                             </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="msgModal<?php echo $row['id']; ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Message from <?php echo htmlspecialchars($row['customer_name']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'new'): ?>
                                <span class="badge bg-danger">New</span>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?php echo ucfirst($row['status']); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'new'): ?>
                                <a href="inquiries.php?mark_read=<?php echo $row['id']; ?>" class="btn btn-sm btn-success" title="Mark Read"><i class="bi bi-check-lg"></i></a>
                            <?php endif; ?>
                            <a href="inquiries.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this inquiry?');"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
