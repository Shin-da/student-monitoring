/**
 * Real-time Manager for Smart Student Monitoring System
 * Handles WebSocket connections, live updates, notifications, and collaborative features
 */

class RealtimeManager {
  constructor() {
    this.ws = null;
    this.isConnected = false;
    this.reconnectAttempts = 0;
    this.maxReconnectAttempts = 5;
    this.reconnectInterval = 1000;
    this.heartbeatInterval = 30000;
    this.heartbeatTimer = null;
    this.eventHandlers = new Map();
    this.pendingMessages = [];
    this.userId = null;
    this.userRole = null;
    this.room = null;
    
    this.init();
  }

  async init() {
    console.log('[Realtime] Initializing Real-time Manager...');
    
    // Get user info from session
    await this.loadUserInfo();
    
    // Setup event handlers
    this.setupEventHandlers();
    
    // Connect to WebSocket
    this.connect();
    
    // Setup heartbeat
    this.setupHeartbeat();
    
    // Setup visibility change handler
    this.setupVisibilityHandler();
    
    console.log('[Realtime] Real-time Manager initialized successfully');
  }

  // Load user information
  async loadUserInfo() {
    try {
      // In a real implementation, this would come from the server
      // For now, we'll use localStorage or session data
      this.userId = localStorage.getItem('user_id') || 'demo-user';
      this.userRole = localStorage.getItem('user_role') || 'student';
      this.room = this.getRoomForUser();
      
      console.log('[Realtime] User info loaded:', {
        userId: this.userId,
        userRole: this.userRole,
        room: this.room
      });
    } catch (error) {
      console.error('[Realtime] Failed to load user info:', error);
    }
  }

  // Get room for user based on role
  getRoomForUser() {
    switch (this.userRole) {
      case 'admin':
        return 'admin-room';
      case 'teacher':
        return 'teacher-room';
      case 'student':
        return 'student-room';
      case 'parent':
        return 'parent-room';
      case 'adviser':
        return 'adviser-room';
      default:
        return 'general-room';
    }
  }

  // Connect to WebSocket server
  connect() {
    try {
      // In production, this would be your actual WebSocket server URL
      const wsUrl = this.getWebSocketUrl();
      
      console.log('[Realtime] Connecting to WebSocket:', wsUrl);
      
      this.ws = new WebSocket(wsUrl);
      
      this.ws.onopen = (event) => {
        console.log('[Realtime] WebSocket connected');
        this.isConnected = true;
        this.reconnectAttempts = 0;
        this.onConnectionOpen(event);
      };
      
      this.ws.onmessage = (event) => {
        this.handleMessage(event);
      };
      
      this.ws.onclose = (event) => {
        console.log('[Realtime] WebSocket disconnected:', event.code, event.reason);
        this.isConnected = false;
        this.onConnectionClose(event);
        this.scheduleReconnect();
      };
      
      this.ws.onerror = (event) => {
        console.error('[Realtime] WebSocket error:', event);
        this.onConnectionError(event);
      };
      
    } catch (error) {
      console.error('[Realtime] Failed to connect:', error);
      this.scheduleReconnect();
    }
  }

  // Get WebSocket URL
  getWebSocketUrl() {
    const protocol = window.location.protocol === 'https:' ? 'wss:' : 'ws:';
    const host = window.location.host;
    
    // For development, use a mock WebSocket
    if (host.includes('localhost') || host.includes('127.0.0.1')) {
      return 'ws://localhost:8080/ws';
    }
    
    return `${protocol}//${host}/ws`;
  }

  // Handle connection open
  onConnectionOpen(event) {
    // Join user room
    this.joinRoom(this.room);
    
    // Send pending messages
    this.sendPendingMessages();
    
    // Emit connection event
    this.emit('connection:open', { event });
    
    // Show connection status
    this.showConnectionStatus('connected');
  }

  // Handle connection close
  onConnectionClose(event) {
    this.clearHeartbeat();
    
    // Emit connection event
    this.emit('connection:close', { event });
    
    // Show connection status
    this.showConnectionStatus('disconnected');
  }

  // Handle connection error
  onConnectionError(event) {
    console.error('[Realtime] Connection error:', event);
    
    // Emit error event
    this.emit('connection:error', { event });
    
    // Show connection status
    this.showConnectionStatus('error');
  }

  // Schedule reconnection
  scheduleReconnect() {
    if (this.reconnectAttempts < this.maxReconnectAttempts) {
      this.reconnectAttempts++;
      const delay = this.reconnectInterval * Math.pow(2, this.reconnectAttempts - 1);
      
      console.log(`[Realtime] Scheduling reconnect attempt ${this.reconnectAttempts} in ${delay}ms`);
      
      setTimeout(() => {
        if (!this.isConnected) {
          this.connect();
        }
      }, delay);
    } else {
      console.error('[Realtime] Max reconnection attempts reached');
      this.showConnectionStatus('failed');
    }
  }

  // Setup heartbeat
  setupHeartbeat() {
    this.heartbeatTimer = setInterval(() => {
      if (this.isConnected) {
        this.send({
          type: 'ping',
          timestamp: Date.now()
        });
      }
    }, this.heartbeatInterval);
  }

  // Clear heartbeat
  clearHeartbeat() {
    if (this.heartbeatTimer) {
      clearInterval(this.heartbeatTimer);
      this.heartbeatTimer = null;
    }
  }

  // Setup visibility change handler
  setupVisibilityHandler() {
    document.addEventListener('visibilitychange', () => {
      if (document.visibilityState === 'visible') {
        // Reconnect if disconnected
        if (!this.isConnected) {
          this.connect();
        }
      } else {
        // Pause heartbeat when tab is hidden
        this.clearHeartbeat();
      }
    });
  }

  // Join room
  joinRoom(room) {
    this.send({
      type: 'join_room',
      room: room,
      userId: this.userId,
      userRole: this.userRole
    });
  }

  // Leave room
  leaveRoom(room) {
    this.send({
      type: 'leave_room',
      room: room,
      userId: this.userId
    });
  }

  // Send message
  send(message) {
    if (this.isConnected && this.ws) {
      try {
        this.ws.send(JSON.stringify(message));
        console.log('[Realtime] Message sent:', message);
      } catch (error) {
        console.error('[Realtime] Failed to send message:', error);
        this.pendingMessages.push(message);
      }
    } else {
      console.log('[Realtime] Message queued (not connected):', message);
      this.pendingMessages.push(message);
    }
  }

  // Send pending messages
  sendPendingMessages() {
    if (this.pendingMessages.length > 0) {
      console.log(`[Realtime] Sending ${this.pendingMessages.length} pending messages`);
      
      this.pendingMessages.forEach(message => {
        this.send(message);
      });
      
      this.pendingMessages = [];
    }
  }

  // Handle incoming messages
  handleMessage(event) {
    try {
      const message = JSON.parse(event.data);
      console.log('[Realtime] Message received:', message);
      
      // Handle pong response
      if (message.type === 'pong') {
        return;
      }
      
      // Emit message event
      this.emit('message', message);
      
      // Handle specific message types
      this.handleMessageType(message);
      
    } catch (error) {
      console.error('[Realtime] Failed to parse message:', error);
    }
  }

  // Handle specific message types
  handleMessageType(message) {
    switch (message.type) {
      case 'notification':
        this.handleNotification(message);
        break;
      case 'grade_update':
        this.handleGradeUpdate(message);
        break;
      case 'attendance_update':
        this.handleAttendanceUpdate(message);
        break;
      case 'user_online':
        this.handleUserOnline(message);
        break;
      case 'user_offline':
        this.handleUserOffline(message);
        break;
      case 'system_alert':
        this.handleSystemAlert(message);
        break;
      case 'chat_message':
        this.handleChatMessage(message);
        break;
      case 'collaboration':
        this.handleCollaboration(message);
        break;
      default:
        console.log('[Realtime] Unknown message type:', message.type);
    }
  }

  // Handle notifications
  handleNotification(message) {
    const { title, body, type, data } = message;
    
    // Show browser notification
    if ('Notification' in window && Notification.permission === 'granted') {
      new Notification(title, {
        body: body,
        icon: '/assets/icons/icon-192x192.png',
        tag: 'ssms-notification',
        data: data
      });
    }
    
    // Show in-app notification
    this.showInAppNotification(title, body, type);
    
    // Emit notification event
    this.emit('notification', message);
  }

  // Handle grade updates
  handleGradeUpdate(message) {
    const { studentId, subject, grade, timestamp } = message;
    
    // Update grade display if current student
    if (studentId === this.userId || this.userRole === 'teacher' || this.userRole === 'admin') {
      this.updateGradeDisplay(studentId, subject, grade);
    }
    
    // Emit grade update event
    this.emit('grade:update', message);
  }

  // Handle attendance updates
  handleAttendanceUpdate(message) {
    const { studentId, date, status, timestamp } = message;
    
    // Update attendance display
    this.updateAttendanceDisplay(studentId, date, status);
    
    // Emit attendance update event
    this.emit('attendance:update', message);
  }

  // Handle user online
  handleUserOnline(message) {
    const { userId, userName, userRole } = message;
    
    this.showUserStatus(userId, userName, 'online');
    
    // Emit user online event
    this.emit('user:online', message);
  }

  // Handle user offline
  handleUserOffline(message) {
    const { userId, userName } = message;
    
    this.showUserStatus(userId, userName, 'offline');
    
    // Emit user offline event
    this.emit('user:offline', message);
  }

  // Handle system alerts
  handleSystemAlert(message) {
    const { title, message: alertMessage, severity, timestamp } = message;
    
    this.showSystemAlert(title, alertMessage, severity);
    
    // Emit system alert event
    this.emit('system:alert', message);
  }

  // Handle chat messages
  handleChatMessage(message) {
    const { from, to, message: chatMessage, timestamp } = message;
    
    this.displayChatMessage(from, chatMessage, timestamp);
    
    // Emit chat message event
    this.emit('chat:message', message);
  }

  // Handle collaboration
  handleCollaboration(message) {
    const { type, data, userId, timestamp } = message;
    
    switch (type) {
      case 'document_edit':
        this.handleDocumentEdit(data);
        break;
      case 'cursor_position':
        this.handleCursorPosition(data);
        break;
      case 'selection_change':
        this.handleSelectionChange(data);
        break;
      default:
        console.log('[Realtime] Unknown collaboration type:', type);
    }
    
    // Emit collaboration event
    this.emit('collaboration', message);
  }

  // Event handling
  on(event, handler) {
    if (!this.eventHandlers.has(event)) {
      this.eventHandlers.set(event, []);
    }
    this.eventHandlers.get(event).push(handler);
  }

  off(event, handler) {
    if (this.eventHandlers.has(event)) {
      const handlers = this.eventHandlers.get(event);
      const index = handlers.indexOf(handler);
      if (index > -1) {
        handlers.splice(index, 1);
      }
    }
  }

  emit(event, data) {
    if (this.eventHandlers.has(event)) {
      this.eventHandlers.get(event).forEach(handler => {
        try {
          handler(data);
        } catch (error) {
          console.error('[Realtime] Event handler error:', error);
        }
      });
    }
  }

  // UI Updates
  showConnectionStatus(status) {
    const statusElement = document.getElementById('realtime-status');
    if (statusElement) {
      statusElement.className = `badge bg-${this.getStatusColor(status)}`;
      statusElement.textContent = this.getStatusText(status);
    }
  }

  getStatusColor(status) {
    switch (status) {
      case 'connected': return 'success';
      case 'disconnected': return 'warning';
      case 'error': return 'danger';
      case 'failed': return 'danger';
      default: return 'secondary';
    }
  }

  getStatusText(status) {
    switch (status) {
      case 'connected': return 'Connected';
      case 'disconnected': return 'Disconnected';
      case 'error': return 'Connection Error';
      case 'failed': return 'Connection Failed';
      default: return 'Unknown';
    }
  }

  showInAppNotification(title, body, type) {
    // Use existing notification system
    if (window.showNotification) {
      window.showNotification(body, type);
    } else {
      // Fallback notification
      const notification = document.createElement('div');
      notification.className = `alert alert-${type} position-fixed`;
      notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.3s ease-out;
      `;
      
      notification.innerHTML = `
        <div class="d-flex align-items-center">
          <strong class="me-2">${title}</strong>
          <span class="me-auto">${body}</span>
          <button type="button" class="btn-close" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
      `;

      document.body.appendChild(notification);

      // Auto remove after 5 seconds
      setTimeout(() => {
        if (notification.parentElement) {
          notification.remove();
        }
      }, 5000);
    }
  }

  showUserStatus(userId, userName, status) {
    console.log(`[Realtime] User ${userName} is ${status}`);
    // Implement user status display
  }

  showSystemAlert(title, message, severity) {
    console.log(`[Realtime] System Alert [${severity}]: ${title} - ${message}`);
    // Implement system alert display
  }

  updateGradeDisplay(studentId, subject, grade) {
    console.log(`[Realtime] Grade update: ${studentId} - ${subject} - ${grade}`);
    // Implement grade display update
  }

  updateAttendanceDisplay(studentId, date, status) {
    console.log(`[Realtime] Attendance update: ${studentId} - ${date} - ${status}`);
    // Implement attendance display update
  }

  displayChatMessage(from, message, timestamp) {
    console.log(`[Realtime] Chat message from ${from}: ${message}`);
    // Implement chat message display
  }

  handleDocumentEdit(data) {
    console.log('[Realtime] Document edit:', data);
    // Implement document collaboration
  }

  handleCursorPosition(data) {
    console.log('[Realtime] Cursor position:', data);
    // Implement cursor position tracking
  }

  handleSelectionChange(data) {
    console.log('[Realtime] Selection change:', data);
    // Implement selection tracking
  }

  // Public API methods
  sendNotification(to, title, message, type = 'info') {
    this.send({
      type: 'notification',
      to: to,
      title: title,
      message: message,
      notificationType: type,
      timestamp: Date.now()
    });
  }

  sendChatMessage(to, message) {
    this.send({
      type: 'chat_message',
      to: to,
      from: this.userId,
      message: message,
      timestamp: Date.now()
    });
  }

  broadcastUpdate(type, data) {
    this.send({
      type: 'broadcast',
      updateType: type,
      data: data,
      from: this.userId,
      timestamp: Date.now()
    });
  }

  // Disconnect
  disconnect() {
    if (this.ws) {
      this.ws.close();
      this.ws = null;
    }
    
    this.clearHeartbeat();
    this.isConnected = false;
  }

  // Get connection status
  getStatus() {
    return {
      connected: this.isConnected,
      reconnectAttempts: this.reconnectAttempts,
      userId: this.userId,
      userRole: this.userRole,
      room: this.room
    };
  }
}

// Initialize Real-time Manager when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  window.realtimeManager = new RealtimeManager();
});

// Export for global access
window.RealtimeManager = RealtimeManager;
