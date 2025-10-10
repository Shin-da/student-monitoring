# 🚀 **Git Collaboration Guide: Frontend + Backend Development**

## **The Lesson Learned**
The issue was that your frontend work got stashed during a merge conflict and was never properly committed to the actual files. Only `.history` backup files were committed, not your working frontend code.

---

## **📋 Step-by-Step Collaboration Workflow**

### **Phase 1: Initial Setup (One-time)**

#### **1. Repository Setup**
```bash
# Clone the repository
git clone https://github.com/Shin-da/student-monitoring.git
cd student-monitoring

# Create your feature branch
git checkout -b feature/frontend-updates
```

#### **2. Communication Setup**
- **Create a shared document** (Google Doc/Notion) for:
  - Current tasks assigned to each developer
  - File ownership (who's working on what)
  - Merge schedule

---

### **Phase 2: Daily Development Workflow**

#### **3. Start of Day - Sync with Team**
```bash
# Always start with a clean slate
git checkout main
git pull origin main

# Create your feature branch for the day
git checkout -b feature/frontend-[date]-[brief-description]
# Example: feature/frontend-2025-01-15-sidebar-improvements
```

#### **4. During Development - Frequent Commits**
```bash
# Work on your files
# ... make changes to CSS, JS, PHP files ...

# Commit frequently with clear messages
git add public/assets/sidebar-complete.css
git commit -m "feat: improve sidebar responsive design for mobile"

git add resources/views/layouts/dashboard.php
git commit -m "feat: add new dashboard layout structure"
```

#### **5. End of Day - Push Your Work**
```bash
# Push your feature branch
git push origin feature/frontend-[date]-[description]

# Create a Pull Request on GitHub
# Title: "Frontend: [Brief description of changes]"
# Description: List all files changed and what was improved
```

---

### **Phase 3: Collaboration & Merging**

#### **6. When Backend Dev Pushes Changes**
```bash
# Check what they've changed
git fetch origin
git log origin/main --oneline -5

# Update your feature branch with their changes
git checkout main
git pull origin main
git checkout feature/frontend-[your-branch]
git merge main
```

#### **7. Handle Merge Conflicts (If Any)**
```bash
# If conflicts occur, resolve them
git status  # See which files have conflicts
# Edit the conflicted files manually
# Remove conflict markers (<<<<<<< ======= >>>>>>>)
# Test your changes
git add [resolved-files]
git commit -m "resolve: merge conflicts with backend changes"
```

#### **8. Before Merging - Final Checks**
```bash
# Test your frontend changes
# Make sure everything works with backend changes
# Update your feature branch one more time
git checkout main
git pull origin main
git checkout feature/frontend-[your-branch]
git merge main
git push origin feature/frontend-[your-branch]
```

---

### **Phase 4: Merging to Main**

#### **9. Merge via Pull Request (Recommended)**
- Go to GitHub
- Create Pull Request: `feature/frontend-[your-branch]` → `main`
- Add description of all changes
- Request review from backend dev
- Merge after approval

#### **10. Alternative: Direct Merge (If you're both working on same machine)**
```bash
# Only if you're both working locally
git checkout main
git merge feature/frontend-[your-branch]
git push origin main
```

---

## **🛡️ Best Practices & Safety Rules**

### **DO's ✅**
- **Always work on feature branches** - Never work directly on main
- **Commit frequently** - Small, focused commits with clear messages
- **Pull before pushing** - Always sync with latest changes
- **Test before merging** - Make sure your changes work with backend
- **Communicate changes** - Tell your backend dev what files you're modifying
- **Use descriptive branch names** - `feature/frontend-2025-01-15-sidebar` not `feature/mike`

### **DON'Ts ❌**
- **Never work on main branch** - Always use feature branches
- **Don't ignore merge conflicts** - Always resolve them properly
- **Don't commit broken code** - Test before committing
- **Don't delete branches immediately** - Keep them for a few days after merging
- **Don't stash and forget** - Always commit your work properly

---

## **🚨 Emergency Recovery (If Things Go Wrong)**

### **If Your Work Gets Lost:**
```bash
# Check for stashed work
git stash list

# Check for uncommitted changes
git status

# Look for your work in other branches
git branch -a
git log --oneline --all --grep="your-work-description"
```

### **If Merge Goes Wrong:**
```bash
# Abort the merge
git merge --abort

# Reset to previous state
git reset --hard HEAD~1

# Start over with proper conflict resolution
```

---

## **📞 Communication Protocol**

### **Daily Check-ins:**
- **Morning**: "I'm working on [specific files] today"
- **Before major changes**: "I'm about to modify [file], any conflicts?"
- **End of day**: "I've pushed [branch name], ready for review"

### **File Ownership:**
- **Frontend**: `public/assets/*`, `resources/views/layouts/*`, CSS/JS files
- **Backend**: `app/Controllers/*`, `api/*`, database files
- **Shared**: `resources/views/*` (communicate before changes)

---

## **🎯 Quick Reference Commands**

```bash
# Daily workflow
git checkout main && git pull origin main
git checkout -b feature/frontend-[description]
# ... work ...
git add . && git commit -m "feat: [description]"
git push origin feature/frontend-[description]

# Sync with backend changes
git checkout main && git pull origin main
git checkout feature/frontend-[your-branch]
git merge main

# Emergency recovery
git stash list
git reflog
git checkout [commit-hash]
```

---

## **📝 Commit Message Convention**

### **Format:**
```
type(scope): brief description

Longer description if needed

- Bullet point for specific changes
- Another bullet point
```

### **Types:**
- `feat`: New feature
- `fix`: Bug fix
- `style`: CSS/styling changes
- `refactor`: Code refactoring
- `docs`: Documentation updates
- `test`: Adding tests

### **Examples:**
```bash
git commit -m "feat(sidebar): add responsive mobile navigation"
git commit -m "fix(dashboard): resolve layout overflow on small screens"
git commit -m "style(forms): improve input field styling and validation"
```

---

## **🔄 Branch Naming Convention**

### **Format:**
```
feature/frontend-[date]-[brief-description]
feature/backend-[date]-[brief-description]
hotfix/[brief-description]
```

### **Examples:**
```bash
feature/frontend-2025-01-15-sidebar-improvements
feature/backend-2025-01-15-user-authentication
hotfix/login-validation-error
```

---

## **📊 Project Status Tracking**

### **Daily Standup Questions:**
1. What did you work on yesterday?
2. What are you working on today?
3. Any blockers or conflicts?
4. What files are you modifying?

### **Weekly Review:**
- Review all merged branches
- Clean up old feature branches
- Update documentation
- Plan next week's tasks

---

## **🛠️ Troubleshooting Common Issues**

### **Issue: "Your branch is behind origin/main"**
```bash
git checkout main
git pull origin main
git checkout your-feature-branch
git merge main
```

### **Issue: "Merge conflict in [file]"**
```bash
# Open the file and look for conflict markers
# <<<<<<< HEAD
# Your changes
# =======
# Their changes
# >>>>>>> branch-name

# Edit to resolve, then:
git add [file]
git commit -m "resolve: merge conflict in [file]"
```

### **Issue: "Changes not showing on website"**
```bash
# Check if files are committed
git status

# Check if changes are pushed
git log --oneline -5

# Clear browser cache
# Check file permissions
```

---

## **📚 Additional Resources**

- [Git Official Documentation](https://git-scm.com/doc)
- [GitHub Flow Guide](https://guides.github.com/introduction/flow/)
- [Conventional Commits](https://www.conventionalcommits.org/)
- [Git Branching Strategies](https://www.atlassian.com/git/tutorials/comparing-workflows)

---

**Last Updated:** January 15, 2025  
**Version:** 1.0  
**Maintainers:** Frontend Dev, Backend Dev
