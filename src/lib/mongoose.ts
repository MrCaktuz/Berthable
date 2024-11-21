import mongoose from "mongoose";

// Define the MongoDB connection string
const DATABASE_URL = process.env.MONGO_ATLAS_URI || "";

if (!DATABASE_URL) {
  throw new Error(
    "Please define the MONGODB_URI environment variable inside .env",
  );
}

const connectDB = async () => {
  try {
    await mongoose.connect(DATABASE_URL);
    console.log("Connected to DB 🎉");
  } catch (error) {
    console.error(`Error when connecting to DB: ${error}`);
  }
};

export default connectDB;
