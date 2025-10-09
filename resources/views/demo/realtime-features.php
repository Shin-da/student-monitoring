<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Features Demo - Smart Student Monitoring System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('app.css') ?>" rel="stylesheet">
    <link href="<?= \Helpers\Url::asset('assets/realtime-styles.css') ?>" rel="stylesheet">
    <style>
        .demo-section {
            margin-bottom: 3rem;
            padding: 2rem;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            background: white;
        }
        
        .feature-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .realtime-status {
            position: sticky;
            top: 20px;
            z-index: 1000;
        }
        
        .live-data-table {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .activity-feed {
            max-height: 400px;
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Real-time Status Indicator -->
    <div id="realtime-status" class="badge bg-secondary">Connecting...</div>
    
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold text-primary">Real-time Features Demo</h1>
                    <p class="lead text-muted">Experience live updates, notifications, and collaborative features</p>
                </div>

                <!-- Connection Status -->
                <div class="demo-section">
                    <h3 class="mb-4">🔌 Connection Status</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">WebSocket Connection</h5>
                                    <p class="card-text">Monitor real-time connection status</p>
                                    <div id="connectionInfo" class="badge bg-secondary">Checking...</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Connection Controls</h5>
                                    <p class="card-text">Test connection management</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-primary btn-sm" onclick="testConnection()">Test Connection</button>
                                        <button class="btn btn-outline-secondary btn-sm" onclick="disconnectRealtime()">Disconnect</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Data Updates -->
                <div class="demo-section">
                    <h3 class="mb-4">📊 Live Data Updates</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Live Counters</h5>
                                    <p class="card-text">Real-time data counters with animations</p>
                                    <div class="d-flex gap-3">
                                        <div class="live-counter">
                                            <div class="h4 mb-0" id="studentCount">1,247</div>
                                            <small class="text-muted">Students</small>
                                        </div>
                                        <div class="live-counter">
                                            <div class="h4 mb-0" id="teacherCount">89</div>
                                            <small class="text-muted">Teachers</small>
                                        </div>
                                        <div class="live-counter">
                                            <div class="h4 mb-0" id="gradeCount">3,456</div>
                                            <small class="text-muted">Grades</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Live Table Data</h5>
                                    <p class="card-text">Real-time table updates</p>
                                    <div class="live-data-table">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Student</th>
                                                    <th>Grade</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="liveTableBody">
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>85</td>
                                                    <td><span class="badge bg-success">Updated</span></td>
                                                </tr>
                                                <tr>
                                                    <td>Jane Smith</td>
                                                    <td>92</td>
                                                    <td><span class="badge bg-success">Updated</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Notifications -->
                <div class="demo-section">
                    <h3 class="mb-4">🔔 Live Notifications</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Test Notifications</h5>
                                    <p class="card-text">Send test real-time notifications</p>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <button class="btn btn-success btn-sm" onclick="sendTestNotification('success')">Success</button>
                                        <button class="btn btn-warning btn-sm" onclick="sendTestNotification('warning')">Warning</button>
                                        <button class="btn btn-danger btn-sm" onclick="sendTestNotification('error')">Error</button>
                                        <button class="btn btn-info btn-sm" onclick="sendTestNotification('info')">Info</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card feature-card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Notification Settings</h5>
                                    <p class="card-text">Configure notification preferences</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gradeNotifications" checked>
                                        <label class="form-check-label" for="gradeNotifications">
                                            Grade Updates
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="attendanceNotifications" checked>
                                        <label class="form-check-label" for="attendanceNotifications">
                                            Attendance Updates
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Activity Feed -->
                <div class="demo-section">
                    <h3 class="mb-4">📈 Live Activity Feed</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="activity-feed" id="activityFeed">
                                <div class="activity-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong>Grade Updated</strong>
                                            <div class="activity-content">John Doe received 85 in Mathematics</div>
                                        </div>
                                        <small class="activity-time">2 minutes ago</small>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong>Attendance Marked</strong>
                                            <div class="activity-content">Jane Smith marked present in English class</div>
                                        </div>
                                        <small class="activity-time">5 minutes ago</small>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong>New Assignment</strong>
                                            <div class="activity-content">Math homework assigned to Grade 10</div>
                                        </div>
                                        <small class="activity-time">10 minutes ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Chat -->
                <div class="demo-section">
                    <h3 class="mb-4">💬 Live Chat</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Real-time Chat</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="live-chat">
                                <div class="chat-messages" id="chatMessages">
                                    <div class="chat-message other">
                                        <div class="d-flex justify-content-between">
                                            <strong>Teacher</strong>
                                            <small>2:30 PM</small>
                                        </div>
                                        <div>Welcome to the live chat demo!</div>
                                    </div>
                                    <div class="chat-message own">
                                        <div class="d-flex justify-content-between">
                                            <strong>You</strong>
                                            <small>2:31 PM</small>
                                        </div>
                                        <div>This is amazing! Real-time communication.</div>
                                    </div>
                                </div>
                                <div class="chat-input">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="chatInput" placeholder="Type a message...">
                                        <button class="btn btn-primary" onclick="sendChatMessage()">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testing Tools -->
                <div class="demo-section">
                    <h3 class="mb-4">🧪 Testing Tools</h3>
                    <div class="row">
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100 mb-3" onclick="simulateGradeUpdate()">
                                Simulate Grade Update
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success w-100 mb-3" onclick="simulateAttendanceUpdate()">
                                Simulate Attendance
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-warning w-100 mb-3" onclick="simulateSystemAlert()">
                                System Alert
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-info w-100 mb-3" onclick="simulateUserOnline()">
                                User Online
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="realtime-status">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Real-time Information</h5>
                        </div>
                        <div class="card-body">
                            <div id="realtimeInfo">
                                <div class="mb-3">
                                    <strong>Connection:</strong>
                                    <span id="connectionStatus" class="badge bg-secondary">Checking...</span>
                                </div>
                                <div class="mb-3">
                                    <strong>User ID:</strong>
                                    <span id="userId">demo-user</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Role:</strong>
                                    <span id="userRole">student</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Room:</strong>
                                    <span id="userRoom">student-room</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Messages Sent:</strong>
                                    <span id="messagesSent">0</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Messages Received:</strong>
                                    <span id="messagesReceived">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary w-100 mb-2" onclick="connectRealtime()">
                                Connect
                            </button>
                            <button class="btn btn-outline-primary w-100 mb-2" onclick="getRealtimeStatus()">
                                Get Status
                            </button>
                            <button class="btn btn-outline-secondary w-100" onclick="clearActivityFeed()">
                                Clear Activity
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= \Helpers\Url::asset('assets/realtime-manager.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let messagesSent = 0;
        let messagesReceived = 0;

        // Initialize real-time demo
        document.addEventListener('DOMContentLoaded', function() {
            updateRealtimeInfo();
            setupEventListeners();
            
            // Simulate some initial activity
            setTimeout(() => {
                addActivityItem('System', 'Real-time system initialized', 'just now');
            }, 1000);
        });

        // Setup event listeners
        function setupEventListeners() {
            // Listen for real-time events
            if (window.realtimeManager) {
                window.realtimeManager.on('connection:open', () => {
                    updateConnectionStatus('connected');
                });
                
                window.realtimeManager.on('connection:close', () => {
                    updateConnectionStatus('disconnected');
                });
                
                window.realtimeManager.on('message', (message) => {
                    messagesReceived++;
                    updateRealtimeInfo();
                    handleRealtimeMessage(message);
                });
            }
            
            // Chat input enter key
            document.getElementById('chatInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    sendChatMessage();
                }
            });
        }

        // Update real-time information
        function updateRealtimeInfo() {
            document.getElementById('messagesSent').textContent = messagesSent;
            document.getElementById('messagesReceived').textContent = messagesReceived;
        }

        // Update connection status
        function updateConnectionStatus(status) {
            const statusElement = document.getElementById('connectionStatus');
            const connectionInfo = document.getElementById('connectionInfo');
            
            statusElement.className = `badge bg-${getStatusColor(status)}`;
            statusElement.textContent = getStatusText(status);
            
            connectionInfo.className = `badge bg-${getStatusColor(status)}`;
            connectionInfo.textContent = getStatusText(status);
        }

        function getStatusColor(status) {
            switch (status) {
                case 'connected': return 'success';
                case 'disconnected': return 'warning';
                case 'error': return 'danger';
                default: return 'secondary';
            }
        }

        function getStatusText(status) {
            switch (status) {
                case 'connected': return 'Connected';
                case 'disconnected': return 'Disconnected';
                case 'error': return 'Error';
                default: return 'Unknown';
            }
        }

        // Test connection
        function testConnection() {
            if (window.realtimeManager) {
                const status = window.realtimeManager.getStatus();
                alert(`Connection Status:
                \nConnected: ${status.connected}
                \nUser ID: ${status.userId}
                \nRole: ${status.userRole}
                \nRoom: ${status.room}`);
            } else {
                alert('Real-time Manager not available');
            }
        }

        // Connect real-time
        function connectRealtime() {
            if (window.realtimeManager) {
                window.realtimeManager.connect();
                updateConnectionStatus('connecting');
            }
        }

        // Disconnect real-time
        function disconnectRealtime() {
            if (window.realtimeManager) {
                window.realtimeManager.disconnect();
                updateConnectionStatus('disconnected');
            }
        }

        // Get real-time status
        function getRealtimeStatus() {
            if (window.realtimeManager) {
                const status = window.realtimeManager.getStatus();
                console.log('Real-time Status:', status);
                alert('Check console for detailed status information');
            }
        }

        // Send test notification
        function sendTestNotification(type) {
            if (window.realtimeManager) {
                window.realtimeManager.sendNotification(
                    'demo-user',
                    'Test Notification',
                    `This is a test ${type} notification`,
                    type
                );
                messagesSent++;
                updateRealtimeInfo();
            }
        }

        // Simulate grade update
        function simulateGradeUpdate() {
            const students = ['John Doe', 'Jane Smith', 'Mike Johnson', 'Sarah Wilson'];
            const subjects = ['Mathematics', 'English', 'Science', 'History'];
            const student = students[Math.floor(Math.random() * students.length)];
            const subject = subjects[Math.floor(Math.random() * subjects.length)];
            const grade = Math.floor(Math.random() * 40) + 60;
            
            // Update live table
            updateLiveTable(student, grade);
            
            // Add activity
            addActivityItem('Grade Update', `${student} received ${grade} in ${subject}`, 'just now');
            
            // Update counter
            updateCounter('gradeCount');
        }

        // Simulate attendance update
        function simulateAttendanceUpdate() {
            const students = ['John Doe', 'Jane Smith', 'Mike Johnson', 'Sarah Wilson'];
            const student = students[Math.floor(Math.random() * students.length)];
            const statuses = ['Present', 'Absent', 'Late'];
            const status = statuses[Math.floor(Math.random() * statuses.length)];
            
            // Add activity
            addActivityItem('Attendance', `${student} marked ${status}`, 'just now');
        }

        // Simulate system alert
        function simulateSystemAlert() {
            const alerts = [
                'System maintenance scheduled for tonight',
                'New feature update available',
                'Database backup completed successfully',
                'High server load detected'
            ];
            const alert = alerts[Math.floor(Math.random() * alerts.length)];
            
            // Add activity
            addActivityItem('System Alert', alert, 'just now');
        }

        // Simulate user online
        function simulateUserOnline() {
            const users = ['Teacher Smith', 'Admin Johnson', 'Student Brown'];
            const user = users[Math.floor(Math.random() * users.length)];
            
            // Add activity
            addActivityItem('User Status', `${user} came online`, 'just now');
        }

        // Update live table
        function updateLiveTable(student, grade) {
            const tbody = document.getElementById('liveTableBody');
            const row = document.createElement('tr');
            row.className = 'table-row-updated';
            row.innerHTML = `
                <td>${student}</td>
                <td class="table-cell-updated">${grade}</td>
                <td><span class="badge bg-success">Updated</span></td>
            `;
            
            tbody.insertBefore(row, tbody.firstChild);
            
            // Remove animation class after animation
            setTimeout(() => {
                row.classList.remove('table-row-updated');
            }, 1000);
        }

        // Update counter
        function updateCounter(counterId) {
            const counter = document.getElementById(counterId);
            const currentValue = parseInt(counter.textContent.replace(/,/g, ''));
            const newValue = currentValue + 1;
            
            counter.textContent = newValue.toLocaleString();
            counter.parentElement.classList.add('updating');
            
            setTimeout(() => {
                counter.parentElement.classList.remove('updating');
            }, 500);
        }

        // Add activity item
        function addActivityItem(type, content, time) {
            const activityFeed = document.getElementById('activityFeed');
            const item = document.createElement('div');
            item.className = 'activity-item new';
            item.innerHTML = `
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong>${type}</strong>
                        <div class="activity-content">${content}</div>
                    </div>
                    <small class="activity-time">${time}</small>
                </div>
            `;
            
            activityFeed.insertBefore(item, activityFeed.firstChild);
            
            // Remove animation class after animation
            setTimeout(() => {
                item.classList.remove('new');
            }, 500);
            
            // Keep only last 10 items
            const items = activityFeed.querySelectorAll('.activity-item');
            if (items.length > 10) {
                items[items.length - 1].remove();
            }
        }

        // Send chat message
        function sendChatMessage() {
            const input = document.getElementById('chatInput');
            const message = input.value.trim();
            
            if (message) {
                const chatMessages = document.getElementById('chatMessages');
                const messageDiv = document.createElement('div');
                messageDiv.className = 'chat-message own';
                messageDiv.innerHTML = `
                    <div class="d-flex justify-content-between">
                        <strong>You</strong>
                        <small>${new Date().toLocaleTimeString()}</small>
                    </div>
                    <div>${message}</div>
                `;
                
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                input.value = '';
                
                // Simulate response
                setTimeout(() => {
                    const responseDiv = document.createElement('div');
                    responseDiv.className = 'chat-message other';
                    responseDiv.innerHTML = `
                        <div class="d-flex justify-content-between">
                            <strong>System</strong>
                            <small>${new Date().toLocaleTimeString()}</small>
                        </div>
                        <div>Message received: "${message}"</div>
                    `;
                    
                    chatMessages.appendChild(responseDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 1000);
            }
        }

        // Clear activity feed
        function clearActivityFeed() {
            const activityFeed = document.getElementById('activityFeed');
            activityFeed.innerHTML = '';
        }

        // Handle real-time message
        function handleRealtimeMessage(message) {
            console.log('Real-time message received:', message);
            
            // Add to activity feed
            addActivityItem('Real-time Message', JSON.stringify(message, null, 2), 'just now');
        }
    </script>
</body>
</html>
