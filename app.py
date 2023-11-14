from flask import Flask, render_template, request
import base64

app = Flask(__name__)

# Placeholder for storing encoded images (simulated database)
encoded_images = {}

def copy_image(image_name):
    if image_name in encoded_images:
        original_encoded_image = encoded_images[image_name]
        # Perform any additional processing or storage logic here
        # For now, let's just create a new name for the copied image
        copied_image_name = f"copy_{image_name}"
        encoded_images[copied_image_name] = original_encoded_image
        return f"Image '{image_name}' copied successfully as '{copied_image_name}'"
    else:
        return f"Image '{image_name}' not found"

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/upload', methods=['POST'])
def upload():
    if 'image' in request.files:
        image_file = request.files['image']
        if image_file.filename != '':
            # Convert image to base64
            encoded_image = base64.b64encode(image_file.read()).decode('utf-8')

            # Store encoded image in the simulated database
            image_name = f"image_{len(encoded_images) + 1}"
            encoded_images[image_name] = encoded_image

            return f"Data URI: data:image/png;base64,{encoded_image}<br>Image Name: {image_name}"
    
    return 'Image upload failed'

@app.route('/copy/<string:image_name>')
def copy(image_name):
    result = copy_image(image_name)
    return result

if __name__ == '__main__':
    app.run(debug=True)
