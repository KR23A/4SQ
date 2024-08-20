from flask import Flask, render_template, request, redirect, url_for
from flask_mail import Mail, Message

app = Flask(__name__)

# Configuration for Flask-Mail
app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 587
app.config['MAIL_USERNAME'] = 'ranpura.kushal03@gmail.com'
app.config['MAIL_PASSWORD'] = 'R@npura2k23'
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USE_SSL'] = False

mail = Mail(app)

@app.route('/contact', methods=['GET', 'POST'])
def contact():
    if request.method == 'POST':
        name = request.form['name']
        email = request.form['email']
        message = request.form['message']

        msg = Message(
            f"Contact Form Submission from {name}",
            sender=email,
            recipients=['your-email@gmail.com'],  # Replace with your email
            body=message
        )
        mail.send(msg)
        return redirect(url_for('success'))

    return render_template('contact.html')

@app.route('/success')
def success():
    return "Thank you for your message. We will get back to you shortly."

if __name__ == '__main__':
    app.run(debug=True)
