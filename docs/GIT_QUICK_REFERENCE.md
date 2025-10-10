# 🚀 **Git Quick Reference Card**

## **Daily Workflow (Copy & Paste)**

### **Start of Day:**
```bash
git checkout main
git pull origin main
git checkout -b feature/frontend-$(date +%Y-%m-%d)-[description]
```

### **During Work:**
```bash
git add [file]
git commit -m "feat: [description]"
```

### **End of Day:**
```bash
git push origin feature/frontend-$(date +%Y-%m-%d)-[description]
```

### **Sync with Backend Changes:**
```bash
git checkout main
git pull origin main
git checkout feature/frontend-[your-branch]
git merge main
```

---

## **Emergency Commands**

### **Lost Your Work?**
```bash
git stash list
git stash show stash@{0}
git stash pop stash@{0}
```

### **Merge Conflict?**
```bash
git status
# Edit conflicted files
git add [resolved-files]
git commit -m "resolve: merge conflicts"
```

### **Undo Last Commit?**
```bash
git reset --soft HEAD~1  # Keep changes
git reset --hard HEAD~1  # Delete changes
```

---

## **File Ownership**

- **Frontend**: `public/assets/*`, `resources/views/layouts/*`
- **Backend**: `app/Controllers/*`, `api/*`
- **Shared**: `resources/views/*` (communicate first!)

---

## **Commit Message Format**
```
type(scope): description

feat(sidebar): add mobile navigation
fix(forms): resolve validation error
style(css): improve button styling
```

---

**Keep this handy! 📌**
